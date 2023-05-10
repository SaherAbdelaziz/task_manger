<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use App\Models\Statistic;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $tasksService;


    public function __construct(TaskService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    public function index()
    {
        $tasks = $this->tasksService->getAllTasks();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $admins = User::where('is_admin', true)->get();
        $users = User::where('is_admin', false)->get();

        return view('tasks.create', compact('admins', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'assigned_to_id' => 'required|exists:users,id',
            'assigned_by_id' => 'required|exists:users,id'
        ]);
        $task = $this->tasksService->createTask($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

}
