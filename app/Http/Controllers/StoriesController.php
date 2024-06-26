<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Story;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\StoriesService;

class StoriesController extends Controller
{
    protected $storiesService;
    public function __construct()
    {
        $this->storiesService = new StoriesService();
    }

    public function index(Request $request)
    {
        return $this->storiesService->index($request);
    }

    public function store(Request $request)
    {
        return $this->storiesService->store($request);
    }

    public function updateView(Request $request)
    {
        return $this->storiesService->updateView($request);
    }

    public function updateLike(Request $request)
    {
        return $this->storiesService->updateLike($request);
    }

    public function updateUnLike(Request $request)
    {
        return $this->storiesService->updateUnLike($request);
    }

    public function destroy(Story $story)
    {
        return $this->storiesService->destroy($story);
    }

    public function nextStory()
    {
        return $this->storiesService->nextStory();
    }
}
