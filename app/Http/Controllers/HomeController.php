<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function index(Request $request)
    {
        return $this->homeService->index();
    }

    public function search(Request $request)
    {
        return $this->homeService->search($request);
    }

    public function filterGame(Request $request)
    {
        return $this->homeService->filterGame($request);
    }
}
