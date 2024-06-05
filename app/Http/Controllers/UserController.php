<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->route('id');
        $user = User::where('id', $id)->first();
        $follow = true;
        $follow = Follow::where('following_user_id', $request->user()->id)
        ->where('followed_user_id', $id)
        ->first();

        return view('user', [
            'user' => $user,
            'follow' => $follow
        ]);
    }
}
