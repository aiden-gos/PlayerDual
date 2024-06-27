<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function __construct()
    {
        //
    }

    public function index($id)
    {
        $comment = Comment::where('story_id', $id)
            ->orderBy('created_at', 'ASC')
            ->get();

        return $comment;
    }

    public function store($id, $content, $user_id)
    {
        $comment = Comment::create([
            'content' => $content,
            'story_id' =>  $id,
            'user_id' => $user_id
        ]);

        return $comment;
    }

    public function destroy($id, $user_id)
    {
        $comment = Comment::find(['id' => $id])->first();

        if ($comment && $user_id == $comment->user->id) {
            $comment->delete();
        }

        return $comment;
    }
}
