<?php

namespace App\Services;

use App\Models\Rate;
use Illuminate\Support\Facades\Log;

class RateService
{
    public function __construct()
    {
        //
    }

    public function saveRate($content, $star, $auth_user, $user_id)
    {
        try {
            Rate::create([
                'content' => $content,
                'star' => $star,
                'user_id' => $user_id,
                'author_id' => $auth_user->id,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }

        return true;
    }
}
