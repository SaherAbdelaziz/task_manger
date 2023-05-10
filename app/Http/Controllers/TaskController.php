<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use App\Models\Statistics;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('assignedTo', 'assignedBy')->paginate(10);
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

        $task = Task::create($request->all());


        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function statistics()
    {
        $statistics = Statistics::with('user')->orderByDesc('count')->paginate(10);
        return view('tasks.statistics', compact('statistics'));
    }
}
