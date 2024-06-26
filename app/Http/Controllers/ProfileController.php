<?php

namespace App\Http\Controllers;

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
        return $this->profileService->edit($request);
    }

    /**
     * Display the user's change password form.
     */
    public function changePassword(Request $request): View
    {
        return $this->profileService->changePassword($request);
    }

    /**
     * Display the user's accout form.
     */
    public function account(Request $request): View
    {
        return $this->profileService->account($request);
    }

    /**
     * Display the user's accout form.
     */
    public function payment(Request $request): View
    {
        return $this->profileService->payment($request);
    }

    /**
     * Display the user's accout form.
     */
    public function gallery(Request $request): View
    {
        return $this->profileService->gallery($request);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        return $this->profileService->update($request);
    }

    /**
     * Update the user's profile information.
     */
    public function updatePayment(ProfileUpdateRequest $request): RedirectResponse
    {
        return $this->profileService->updatePayment($request);
    }

    /**
     * Update the user's profile information.
     */
    public function updateAvatar(ProfileUpdateRequest $request): RedirectResponse
    {
        return $this->profileService->updateAvatar($request);
    }

    /**
     *
     */
    public function uploadGallery(ProfileUpdateRequest $request): RedirectResponse
    {
        return $this->profileService->uploadGallery($request);
    }

    public function uploadDropbox(Request $request)
    {
        return $this->profileService->uploadDropbox($request);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        return $this->profileService->destroy($request);
    }

    public function deleteGallery(Request $request)
    {
        return $this->profileService->deleteGallery($request);
    }
}
