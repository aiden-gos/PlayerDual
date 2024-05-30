<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Gallery;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's change password form.
     */
    public function changePassword(Request $request): View
    {
        return view('profile.password', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's accout form.
     */
    public function account(Request $request): View
    {
        return view('profile.account', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's accout form.
     */
    public function payment(Request $request): View
    {
        return view('profile.payment', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's accout form.
     */
    public function gallery(Request $request): View
    {
        $gallery = Gallery::where('user_id', $request->user()->id)->get();

        return view('profile.gallery', [
            'user' => $request->user(),
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function updatePayment(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.payment')->with('status', 'payment-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function updateAvatar(ProfileUpdateRequest $request): RedirectResponse
    {
        if($request->hasFile('avatar')) {
            if(!empty($request->user()->avatar)){
                try {
                    $public_id =  explode('.',explode('/', $request->user()->avatar)[7])[0];
                    Cloudinary::destroy($public_id);
                } catch (\Throwable $th) {
                    Log::error("Error detroy old avatar");
                }
            }
            $uploaded= Cloudinary::upload($request->file('avatar')->getRealPath());
            $uploadedFileUrl = $uploaded->getSecurePath();
            Log::debug($uploadedFileUrl);
        }
        $request->user()->update(['avatar'=> $uploadedFileUrl]);
        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }

     /**
     *
     */
    public function uploadGallery(ProfileUpdateRequest $request): RedirectResponse
    {
        if($request->hasFile('upload')) {
            if(in_array($request->file('upload')->guessExtension(),['jpg','png','gif'])){
                $uploaded= Cloudinary::upload($request->file('upload')->getRealPath());
                $uploadedFileUrl = $uploaded->getSecurePath();
                Gallery::create(['type'=>'image', 'link'=>$uploadedFileUrl, 'user_id'=> $request->user()->id]);
            }else if(in_array($request->file('upload')->guessExtension(),['mp4','wmv','avi'])){
                $uploaded= Cloudinary::uploadVideo($request->file('upload')->getRealPath());
                $uploadedFileUrl = $uploaded->getSecurePath();
                Gallery::create(['type'=>'video', 'link'=>$uploadedFileUrl, 'user_id'=> $request->user()->id]);
            }
        }
        return Redirect::route('profile.gallery');
    }

    /**
     * Delete the user's account.
     */
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
