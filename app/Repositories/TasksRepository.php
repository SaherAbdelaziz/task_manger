<?php

namespace App\Repositories;

use App\Models\Task;

class TasksRepository
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }
    public function getAllTasks()
    {
        return $this->model::with('assignedTo', 'assignedBy')->paginate(10);
    }

    public function createTask(array $all)
    {
        return $this->model::create($all);
    }

}
