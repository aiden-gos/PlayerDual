<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct()
    {
        $this->profileService = new ProfileService();
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $auth_user = $request->user();
        $data = $this->profileService->edit($auth_user);

        return view('profile.edit', $data);
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
        $data = $this->profileService->payment($request->user());

        return view('profile.payment', $data);
    }

    /**
     * Display the user's accout form.
     */
    public function gallery(Request $request)
    {
        $auth_user = $request->user();
        $data = $this->profileService->gallery($auth_user);

        return view('profile.gallery', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        $auth_user = $request->user();
        $micro = $request->input('micro');
        $camera = $request->input('camera');
        $games = $request->input('games');

        $result = $this->profileService->update($auth_user, $micro, $camera, $games);

        if (!$result) {
            return redirect()->back()->with('error', 'Update profile order failure.');
        }

        return redirect()->back()->with('success', 'Update profile successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function updatePayment(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $result = $this->profileService->updatePayment($request);

        if (!$result) {
            return Redirect::route('profile.payment')->with('status', 'payment-update-error');
        }

        return Redirect::route('profile.payment')->with('status', 'payment-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function updateAvatar(Request $request)
    {
        $auth_user = $request->user()->id;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
        } else {
            return Redirect::route('profile.edit')->with('status', 'avatar-updated-error');
        }

        $result = $this->profileService->updateAvatar($auth_user, $file);

        if (!$result) {
            return Redirect::route('profile.edit')->with('status', 'avatar-updated-error');
        }

        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }

    public function uploadGallery(ProfileUpdateRequest $request): RedirectResponse
    {
        $auth_user = $request->user();

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
        } else {
            return Redirect::route('profile.gallery')->with('status', 'gallery-updated-error');
        }

        $result = $this->profileService->uploadGallery($auth_user, $file);

        if (!$result) {
            return Redirect::route('profile.gallery')->with('status', 'gallery-updated-error');
        }

        return Redirect::route('profile.gallery')->with('status', 'gallery-updated');
    }

    public function uploadDropbox(Request $request)
    {
        $auth_user = $request->user();
        $link = $request->input('link');

        $result = $this->profileService->uploadDropbox($auth_user, $link);

        if (!$result) {
            return Redirect::route('profile.gallery')->with('status', 'gallery-updated-error');
        }

        return Redirect::route('profile.gallery')->with('status', 'gallery-updated');
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

        $result = $this->profileService->destroy($user);

        if ($result) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return Redirect::to('/');
    }

    public function deleteGallery(Request $request)
    {
        $auth_user = $request->user();
        $src = $request->input('link');

        $result = $this->profileService->deleteGallery($auth_user, $src);

        if (!$result) {
            response()->json(['msg' => 'Delete gallery failure'], 400);
        }

        response()->json(['msg' => 'Delete gallery successfully'], 200);
    }
}
