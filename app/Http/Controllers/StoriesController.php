<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Log;

class StoriesController extends Controller
{
    public function index(Request $request)
    {
        $stories = Story::all()->take(20);
        $top_stories = Story::orderBy("like", "DESC")->take(10)->get();
        return view('stories.stories', ['stories' => $stories, 'top_stories' => $top_stories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_link' => 'nullable|url',
            'content' => 'required',
        ]);

        Story::create([
            'title' => $request->title,
            'video_link' => $request->video_link,
            'content' => $request->content,
        ]);

        return redirect()->route('stories.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_link' => 'nullable|url',
            'content' => 'required',
        ]);

        $id = $request->route('id');
        try {
            Story::find(['id' => $id])->first()->update([
                'title' => $request->title,
                'video_link' => $request->video_link,
                'content' => $request->content,
            ]);
        } catch (\Exception $e) {
            Log::error($e);
        }

        return redirect()->route('stories.index');
    }

    public function destroy(Story $story)
    {
        $story->delete();

        return redirect()->route('stories.index');
    }
}
