<?php

namespace App\Services;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Story;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StoriesService
{
    public function __construct()
    {
        //
    }

    public function index($auth_user)
    {
        $stories_query = Story::where('status', 'open');

        if (isset($auth_user->id)) {
            $stories_query->orderByRaw("user_id = ? DESC", $auth_user->id);
        }

        $stories_query->orderBy("created_at", "DESC");

        $stories = $stories_query->paginate(20);

        $top_stories = Story::where('status', 'open')->orderBy("view", "DESC")->take(10)->get();

        return ['stories' => $stories, 'top_stories' => $top_stories];
    }

    public function store($auth_user, $content, $file)
    {
        $upload = self::uploadFileStoryTemp($file);

        if ($upload) {
            Story::create([
                'title' => 'Story',
                'status' => 'open',
                'video_link' => $upload,
                'content' => $content,
                'user_id' => $auth_user,
            ]);
        } else {
            return false;
        }

        return true;
    }

    public function updateView($id)
    {
        try {
            $story = Story::find(['id' => $id])->first();
            $story->update([
                "view" => $story->view + 1
            ]);
            return response()->json($story);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
        return $story;
    }

    public function updateLike($auth_user, $id)
    {
        DB::beginTransaction();
        try {
            $story = Story::find(['id' => $id])->first();
            $story->likes()->create([
                'user_id' => $auth_user->id
            ]);
            $story->update([
                "like" => Like::where('story_id', $id)->count()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }

        return true;
    }

    public function updateUnLike($auth_user, $id)
    {
        DB::beginTransaction();
        try {
            $story = Story::find(['id' => $id])->first();

            $like = Like::where('story_id', $id)->where('user_id', $auth_user->id);
            if ($like) {
                $like->delete();
            }

            $story->update([
                "like" => Like::where('story_id', $id)->count()
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }

        return true;
    }

    private function uploadFileStoryTemp($file)
    {
        try {
            $uploaded = Cloudinary::uploadVideo($file->getRealPath());
            $uploadedFileUrl = $uploaded->getSecurePath();
            return $uploadedFileUrl;
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    private function uploadFileStory($auth_user, $file)
    {
        try {
            $fileName = time() . '.' . $file->guessExtension();
            $tempPath = $file->storeAs('temp', $fileName, 'public');
            $absolutePath = Storage::path('public');
            $upload = Dropbox::files()->upload($auth_user->id, $absolutePath . "/" . $tempPath);
            Storage::disk('public')->delete($tempPath);

            return $upload->path_lower;
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    public function nextStory()
    {
        $story = Story::inRandomOrder()->first();
        return $story;
    }
}
