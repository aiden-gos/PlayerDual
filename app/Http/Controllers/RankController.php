<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\RankService;

class RankController extends Controller
{
    protected $rankService;

    public function __construct()
    {
        $this->rankService = new RankService();
    }

    public function getRankIncome(Request $request)
    {
        return $this->rankService->getRankIncome($request);
    }

    public function getRankOutcome(Request $request)
    {
        return $this->rankService->getRankOutcome($request);
    }
}
