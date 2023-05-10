<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Services\StatisticService;

class StatisticController extends Controller
{
    private $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function index()
    {
        $statistics = $this->statisticService->getAllStatistics();
        return view('statistics.index', compact('statistics'));
    }
}
