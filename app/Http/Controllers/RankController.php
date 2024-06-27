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
        $result = $this->rankService->getRankIncome($request);

        return response()->json($result, 200);
    }

    public function getRankOutcome(Request $request)
    {
        $result = $this->rankService->getRankOutcome($request);

        return response()->json($result, 200);
    }
}
