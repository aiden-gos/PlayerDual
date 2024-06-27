<?php

namespace App\Services;

use App\Models\Follow;

class FollowService
{
    public function __construct()
    {
        //
    }

    public function store($following_user_id, $followed_user_id)
    {
        $follow = Follow::where('following_user_id', $following_user_id)
            ->where('followed_user_id', $followed_user_id)
            ->first();

        if (!$follow) {
            Follow::create([
                'following_user_id' => $following_user_id,
                'followed_user_id' => $followed_user_id
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function destroy($following_user_id, $followed_user_id)
    {
        $follow = Follow::where('following_user_id', $following_user_id)
            ->where('followed_user_id', $followed_user_id)
            ->first();

        if ($follow) {
            $follow->delete();
            return false;
        }

        return true;
    }
}
