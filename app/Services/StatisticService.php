<?php

namespace App\Services;

use App\Repositories\StatisticRepository;

class StatisticService
{
    private $statisticRepository;

    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    public function getAllStatistics()
    {
        return $this->statisticRepository->getAllStatistics();
    }

}
