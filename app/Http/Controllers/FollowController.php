<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FollowController extends Controller
{
    public function store(Request $request)
    {
        $follow = Follow::where('following_user_id', $request->user()->id)
        ->where('followed_user_id', $request->input('id'))
        ->first();

        if(!$follow){
            Follow::create([
                'following_user_id' => $request->user()->id,
                'followed_user_id' => $request->input('id')
            ]);
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $follow = Follow::where('following_user_id', $request->user()->id)
                ->where('followed_user_id', $request->input('id'))
                ->first();

        if ($follow) {
            $follow->delete();
        }

        return redirect()->back();
    }
}
