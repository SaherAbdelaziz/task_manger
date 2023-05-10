@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Task List') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Description') }}</th>
                                <th scope="col">{{ __('Assigned To') }}</th>
                                <th scope="col">{{ __('Assigned By') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->assignedTo->name }}</td>
                                    <td>{{ $task->assignedBy->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $tasks->links() }}
                        </div>
                        <div class="d-flex justify-content-between">
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
                            @endif
                            <a href="{{ route('tasks.statistics') }}" class="btn btn-primary">Statistics</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
