@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Task Statistics') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('User') }}</th>
                                <th scope="col">{{ __('Tasks Assigned') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($statistics as $statistic)
                                <tr>
                                    <td>{{ $statistic->user->name }}</td>
                                    <td>{{ $statistic->count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
