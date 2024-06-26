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
use App\Services\ProfileService;

class ProfileService
{
    public function __construct()
    {
        //
    }
 
    public function edit(Request $request): View
    {
        $games =  Game::all();

        return view('profile.edit', [
            'user' => $request->user(),
            'games' => $games
        ]);
    }

    public function changePassword(Request $request): View
    {
        return view('profile.password', [
            'user' => $request->user(),
        ]);
    }

    public function account(Request $request): View
    {
        return view('profile.account', [
            'user' => $request->user(),
        ]);
    }

    public function payment(Request $request): View
    {
        return view('profile.payment', [
            'user' => $request->user(),
            'payment_method' => $request->user()->paymentMethods(),
            'intent' => $request->user()->createSetupIntent()
        ]);
    }

    public function gallery(Request $request): View
    {
        $gallery = Gallery::where('user_id', $request->user()->id)->get();

        return view('profile.gallery', [
            'user' => $request->user(),
            'gallery' => $gallery
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->micro = $request->has('micro') ? 1 : 0;
        $request->user()->camera = $request->has('camera') ? 1 : 0;
        $request->user()->save();

        $request->user()->games()->sync($request->input('games'));

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePayment(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.payment')->with('status', 'payment-updated');
    }

    public function updateAvatar(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('avatar')) {
            if (!empty($request->user()->avatar)) {
                try {
                    $public_id =  explode('.', explode('/', $request->user()->avatar)[7])[0];
                    Cloudinary::destroy($public_id);
                } catch (\Throwable $th) {
                    Log::error("Error detroy old avatar");
                }
            }
            $uploaded = Cloudinary::upload($request->file('avatar')->getRealPath());
            $uploadedFileUrl = $uploaded->getSecurePath();
            Log::debug($uploadedFileUrl);
        }
        $request->user()->update(['avatar' => $uploadedFileUrl]);
        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }

    public function uploadGallery(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('upload')) {
            if (in_array(
                $request->file('upload')->guessExtension(),
                ['jpg', 'png', 'gif']
            )) {
                $uploaded = Cloudinary::upload($request->file('upload')->getRealPath());
                $uploadedFileUrl = $uploaded->getSecurePath();
                Gallery::create([
                    'type' => 'image', 'link' => $uploadedFileUrl,
                    'user_id' => $request->user()->id
                ]);
            } elseif (in_array(
                $request->file('upload')->guessExtension(),
                ['mp4', 'wmv', 'avi']
            )) {
                $uploaded = Cloudinary::uploadVideo($request->file('upload')->getRealPath());

                $uploadedFileUrl = $uploaded->getSecurePath();
                Gallery::create([
                    'type' => 'video', 'link' => $uploadedFileUrl,
                    'user_id' => $request->user()->id
                ]);
            }
        }
        return Redirect::route('profile.gallery');
    }

    public function deleteGallery(Request $request)
    {
        try {
            $src = $request->input('link');

            $gallery = Gallery::where(['link' => $src])->first();

            if($gallery && $gallery->user_id == $request->user()->id) {
                $gallery->delete();
            } else {
                return response()->json(['msg'=>'Delete gallery fail'], 400);
            }

        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['msg'=>'Delete gallery fail'], 400);
        }

        return response()->json(['msg'=>'Delete gallery success'], 200);
    }

    public function uploadDropbox(Request $request)
    {
        $link = $request->input('link');

        if (in_array(
            array_reverse(explode('.', $link))[0],
            ['jpg', 'png', 'gif']
        )) {
            Gallery::create(['type' => 'image', 'link' => $link, 'user_id' => $request->user()->id]);
        } elseif (in_array(
            array_reverse(explode('.', $link))[0],
            ['mp4', 'wmv', 'avi']
        )) {
            Gallery::create(['type' => 'video', 'link' => $link, 'user_id' => $request->user()->id]);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}