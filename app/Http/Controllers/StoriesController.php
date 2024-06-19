<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Story;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StoriesController extends Controller
{
    public function index(Request $request)
    {
        $stories_query = Story::where('status', 'open');

        if (isset($request->user()->id))
            $stories_query->orderByRaw("user_id = ? DESC", $request->user()->id);

        $stories_query->orderBy("created_at", "DESC");

        $stories = $stories_query->paginate(20);

        $top_stories = Story::where('status', 'open')->orderBy("view", "DESC")->take(10)->get();

        return view('stories.stories', ['stories' => $stories, 'top_stories' => $top_stories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'upload' => 'required',
            'content' => 'required',
        ]);
        $upload = self::uploadFileStoryTemp($request);

        Story::create([
            'title' => 'Story',
            'status' => 'open',
            'video_link' => $upload,
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->back();
    }

    public function updateView(Request $request)
    {
        $id = $request->route('id');
        try {
            $story = Story::find(['id' => $id])->first();
            $story->update([
                "view" => $story->view + 1
            ]);
            return response()->json($story);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    public function updateLike(Request $request)
    {
        $id = $request->route('id');
        DB::beginTransaction();
        try {
            $story = Story::find(['id' => $id])->first();
            $story->likes()->create([
                'user_id' => $request->user()->id
            ]);
            $story->update([
                "like" => Like::where('story_id', $id)->count()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }

    public function updateUnLike(Request $request)
    {
        $id = $request->route('id');
        DB::beginTransaction();
        try {
            $story = Story::find(['id' => $id])->first();

            $like = Like::where('story_id', $id)->where('user_id', $request->user()->id);
            if ($like) $like->delete();

            $story->update([
                "like" => Like::where('story_id', $id)->count()
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }

    public function destroy(Story $story)
    {
        $story->delete();

        return redirect()->route('stories.index');
    }

    private function uploadFileStoryTemp(Request $request)
    {
        try {
            if (in_array($request->file('upload')->guessExtension(), ['mp4'])) {
                $uploaded = Cloudinary::uploadVideo($request->file('upload')->getRealPath());
                $uploadedFileUrl = $uploaded->getSecurePath();
                return $uploadedFileUrl;
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back();
        }
    }

    private function uploadFileStory(Request $request)
    {
        try {
            $file = $request->file('upload');
            $fileName = time() . '.' . $request->file('upload')->guessExtension();
            $tempPath = $file->storeAs('temp', $fileName, 'public');
            $absolutePath = Storage::path('public');
            $upload = Dropbox::files()->upload($request->user()->id, $absolutePath . "/" . $tempPath);
            Storage::disk('public')->delete($tempPath);

            return $upload->path_lower;
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back();
        }
    }

    public function nextStory()
    {
        $story = Story::inRandomOrder()->first();
        return response()->json($story);
    }
}
