<?php

namespace App\Services;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Gallery;
use App\Models\Game;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileService
{
    public function __construct()
    {
        //
    }

    public function edit($auth_user)
    {
        $games =  Game::all();

        return [
            'user' => $auth_user,
            'games' => $games
        ];
    }

    public function payment($auth_user)
    {
        return [
            'user' => $auth_user,
            'payment_method' => $auth_user->paymentMethods(),
            'intent' => $auth_user->createSetupIntent()
        ];
    }

    public function gallery($auth_user)
    {
        $gallery = Gallery::where('user_id', $auth_user->id)->get();

        return [
            'user' => $auth_user,
            'gallery' => $gallery
        ];
    }

    public function update($auth_user, $micro, $camera, $games)
    {
        if ($auth_user->isDirty('email')) {
            $auth_user->email_verified_at = null;
        }

        $auth_user->micro = $micro ? 1 : 0;
        $auth_user->camera = $micro ? 1 : 0;

        try {
            $auth_user->save();
            $auth_user->games()->sync($games);
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }

        return true;
    }

    public function updatePayment($auth_user)
    {
        try {
            $auth_user->save();
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    public function updateAvatar($auth_user, $file)
    {
        try {
            if (!empty($auth_user->avatar)) {
                $public_id =  explode('.', explode('/', $auth_user->avatar)[7])[0];
                Cloudinary::destroy($public_id);
            }

            $uploaded = Cloudinary::upload($file->getRealPath());
            $uploadedFileUrl = $uploaded->getSecurePath();

            $auth_user->update(['avatar' => $uploadedFileUrl]);
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    public function uploadGallery($auth_user, $file)
    {
        try {
            if (in_array(
                $file->guessExtension(),
                ['jpg', 'png', 'gif']
            )) {
                $uploaded = Cloudinary::upload($file->getRealPath());
                $uploadedFileUrl = $uploaded->getSecurePath();
                Gallery::create([
                    'type' => 'image', 'link' => $uploadedFileUrl,
                    'user_id' => $auth_user->id
                ]);
            } elseif (in_array(
                $file->guessExtension(),
                ['mp4', 'wmv', 'avi']
            )) {
                $uploaded = Cloudinary::uploadVideo($file->getRealPath());

                $uploadedFileUrl = $uploaded->getSecurePath();
                Gallery::create([
                    'type' => 'video', 'link' => $uploadedFileUrl,
                    'user_id' => $auth_user->id
                ]);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }

        return true;
    }

    public function deleteGallery($auth_user, $src)
    {
        try {
            $gallery = Gallery::where(['link' => $src])->first();

            if ($gallery && $gallery->user_id == $auth_user->id) {
                $gallery->delete();
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }

        return true;
    }

    public function uploadDropbox($auth_user, $link)
    {
        try {
            if (in_array(
                array_reverse(explode('.', $link))[0],
                ['jpg', 'png', 'gif']
            )) {
                Gallery::create(['type' => 'image', 'link' => $link, 'user_id' => $auth_user->id]);
            } elseif (in_array(
                array_reverse(explode('.', $link))[0],
                ['mp4', 'wmv', 'avi']
            )) {
                Gallery::create(['type' => 'video', 'link' => $link, 'user_id' => $auth_user->id]);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    public function destroy($user)
    {
        try {
            Auth::logout();
            $user->delete();
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }

        return true;
    }
}
