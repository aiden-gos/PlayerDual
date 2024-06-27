<?php

namespace App\Http\Controllers;

use App\Events\EventActionNotify;
use App\Models\Donate;
use App\Models\User;
use App\Notifications\ActionNotify;
use App\Services\DonateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class DonateController extends Controller
{
    protected $donateService;

    public function __construct()
    {
        $this->donateService = new DonateService();
    }

    public function donate(Request $request)
    {
        $money = $request->input('money');
        $user_id = $request->input('user_id');
        $msg = $request->input('msg');

        $this->donateService->donate($request->user(), $money, $msg, $user_id);

        return redirect()->back();
    }
}
