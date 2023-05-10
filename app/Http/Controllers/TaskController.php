<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use App\Models\Statistics;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('assignedTo', 'assignedBy')->paginate(10);
        info($tasks);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $admins = User::where('is_admin', true)->get();
        $users = User::where('id', 1)->get();

        return view('tasks.create', compact('users', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'assigned_to_id' => 'required|exists:users,id',
            'assigned_by_id' => 'required|exists:users,id'
        ]);

        $task = Task::create($request->all());

        // Update statistics
        $user = User::find($request->assigned_to_id);
        $statistics = $user->statistics ?? new Statistics(['user_id' => $user->id]);
        $statistics->count += 1;
        $statistics->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function statistics()
    {
        $statistics = Statistics::with('user')->orderByDesc('count')->paginate(10);
        info($statistics);
        return view('tasks.statistics', compact('statistics'));
    }
}
