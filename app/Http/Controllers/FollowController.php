<?php

namespace App\Http\Controllers;

use App\Services\FollowService;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    protected $followService;

    public function __construct()
    {
        $this->followService = new FollowService();
    }

    public function store(Request $request)
    {
        $following_user_id = $request->user()->id;
        $followed_user_id = $request->input('id');

        if ($followed_user_id && $following_user_id) {
            $this->followService->store($following_user_id, $followed_user_id);
        } else {
            return redirect()->back()->with('error', 'Follow failure.');
        }

        return redirect()->back()->with('success', 'Follow successfully.');
    }

    public function destroy(Request $request)
    {
        $following_user_id = $request->user()->id;
        $followed_user_id = $request->input('id');

        if ($followed_user_id && $following_user_id) {
            $this->followService->destroy($following_user_id, $followed_user_id);
        } else {
            return redirect()->back()->with('error', 'Unfollow failure.');
        }

        return redirect()->back()->with('success', 'Unfollow successfully.');
    }
}
