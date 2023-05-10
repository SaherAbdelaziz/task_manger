<?php

namespace App\Services;

use App\Repositories\TasksRepository;

class TaskService
{
    private $tasksRepository;

    public function __construct(TasksRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    public function getAllTasks()
    {
        return $this->tasksRepository->getAllTasks();
    }

    public function createTask(array $all)
    {
        return $this->tasksRepository->createTask($all);
    }

}
