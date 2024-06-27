<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Services\RateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RateController extends Controller
{
    protected $rateService;

    public function __construct()
    {
        $this->rateService = new RateService();
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'star' => 'required|integer|min:1|max:5',
            'user_id' => 'required',
        ]);

        $content = $request->input('content');
        $star = $request->input('star');
        $auth_user = $request->user();
        $user_id = $request->input('user_id');

        $result = $this->rateService->saveRate($content, $star, $auth_user, $user_id);

        if (!$result) {
            return redirect()->back()->with('error', 'Add rate failure.');
        }

        return redirect()->back()->with('success', 'Add rate successfully.');
    }
}
