<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Services\StoriesService;

class StoriesController extends Controller
{
    protected $storiesService;

    public function __construct()
    {
        $this->storiesService = new StoriesService();
    }

    public function index(Request $request)
    {
        $auth_user = $request->user();
        $data = $this->storiesService->index($auth_user);

        return view('stories.stories', $data);
    }

    public function store(Request $request)
    {
        $auth_user = $request->user();

        $request->validate([
            'upload' => 'required',
            'content' => 'required',
        ]);
        $file = $request->file('upload');
        $content = $request->input('content');

        $result = $this->storiesService->store($auth_user, $content, $file);

        if (!$result) {
            return redirect()->back()->with('error', 'Add stories failure.');
        }

        return redirect()->back()->with('success', 'Add stories successfully.');
    }

    public function updateView(Request $request)
    {
        $story_id = $request->route('id');
        if (!$story_id) {
            return response()->json(['msg' => "Bad request"], 400);
        }

        $result = $this->storiesService->updateView($story_id);

        if (!$result) {
            return response()->json(['msg' => "Update view failure"], 400);
        }

        return response()->json($result, 200);
    }

    public function updateLike(Request $request)
    {
        $auth_user = $request->user();
        $story_id = $request->route('id');

        if (!$story_id) {
            return response()->json(['msg' => "Bad request"], 400);
        }

        $result = $this->storiesService->updateLike($auth_user, $story_id);

        if (!$result) {
            return response()->json(['msg' => "Like failure"], 400);
        }

        return response()->json(['msg' => "Like successfully"], 200);
    }

    public function updateUnLike(Request $request)
    {
        $auth_user = $request->user();
        $story_id = $request->route('id');

        if (!$story_id) {
            return response()->json(['msg' => "Bad request"], 400);
        }

        $result = $this->storiesService->updateUnLike($auth_user, $story_id);

        if (!$result) {
            return response()->json(['msg' => "Unlike failure"], 400);
        }

        return response()->json(['msg' => "Unlike successfully"], 200);
    }

    public function nextStory()
    {
        $data = $this->storiesService->nextStory();

        return response()->json($data, 200);
    }
}
