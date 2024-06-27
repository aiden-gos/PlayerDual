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
        $day = $request->route('day') ?? 1;
        $result = $this->rankService->getRankIncome($day);

        return response()->json($result, 200);
    }

    public function getRankOutcome(Request $request)
    {
        $day = $request->route('day') ?? 1;
        $result = $this->rankService->getRankOutcome($day);

        return response()->json($result, 200);
    }
}
