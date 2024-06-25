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
        return $this->rateService->saveRate($request);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');

        return $this->rateService->updateRate($request, $id);
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');

        return $this->rateService->deleteRate($request, $id);
    }
}
