<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct()
    {
        $this->commentService = new CommentService();
    }

    public function index(Request $request)
    {
        $id = $request->route('id');

        if ($id) {
            $comment = $this->commentService->index($id);

            return response()->json($comment);
        } else {
            return response()->json(["msg" => "Require id"], 400);
        }
    }

    public function store(Request $request)
    {
        $id = $request->route('id');
        $content = $request->input('content');

        if ($id) {
            $comment = $this->commentService->store($id, $content, $request->user()->id);
            return response()->json($comment);
        } else {
            return response()->json(["msg" => "Require id"], 400);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->route('id');

        if ($id) {
            $comment = $this->commentService->destroy($id, $request->user()->id);
            return response()->json($comment);
        } else {
            return response()->json(["msg" => "Require id"], 400);
        }
    }
}
