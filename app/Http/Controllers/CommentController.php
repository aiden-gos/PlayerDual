<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->route('id');

        $comment = Comment::where('story_id', $id)
            // ->orderByRaw('CASE WHEN story_id = ? THEN 0 ELSE 1 END, created_at ASC', [$request->user()->id])
            ->orderBy('created_at', 'ASC')
            ->get();
        return response()->json($comment);
    }

    public function store(Request $request)
    {
        $id = $request->route('id');
        $content = $request->input('content');
        $comment = Comment::create([
            'content' => $content,
            'story_id' =>  $id,
            'user_id' => $request->user()->id,

        ]);
        return response()->json($comment);
    }

    public function destroy(Request $request)
    {
        $id = $request->route('id');

        $comment = Comment::find(['id' => $id])->first();

        if ($comment && $request->user()->id == $comment->user->id) {
            $comment->delete();
        }
        return response()->json($comment);
    }
}
