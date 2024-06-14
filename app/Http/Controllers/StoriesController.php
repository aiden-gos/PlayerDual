<?php

namespace App\Http\Controllers;

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
        $stories = Story::where('status', 'open')
            ->orderByRaw("user_id = ? DESC", $request->user()->id)
            ->orderBy("created_at", "DESC")
            // ->take(20)
            ->get();
        Log::alert($stories);
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
            $story->update([
                "like" => $story->like + 1
            ]);
            $story->likes()->create([
                'user_id' => $request->user()->id
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
}
