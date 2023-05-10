<?php

namespace App\Repositories;

use App\Models\Statistic;

class StatisticRepository
{
    protected $model;

    public function __construct(Statistic $model)
    {
        $this->model = $model;
    }
    public function getAllStatistics()
    {
        return $this->model::with('user')->orderByDesc('count')->paginate(10);
    }

}
