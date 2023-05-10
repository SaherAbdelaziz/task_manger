@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Task</div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.store') }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('assigned_by_id') ? ' has-error' : '' }}">
                                <label for="assigned_by_id" class="col-md-4 control-label">Assigned To</label>

                                <div class="col-md-6">
                                    <select id="assigned_by_id" class="form-control" name="assigned_by_id" required>
                                        @foreach ($admins as $admin)
                                            <option value="{{ $admin->id }}" {{ old('assigned_by_id') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('assigned_by_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('assigned_by_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" required>{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('assigned_to_id') ? ' has-error' : '' }}">
                                <label for="assigned_to_id" class="col-md-4 control-label">Assigned To</label>

                                <div class="col-md-6">
                                    <select id="assigned_to_id" class="form-control" name="assigned_to_id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('assigned_to_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('assigned_to_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

{{--                            <input type="hidden" name="assigned_by_id" value="{{ Auth::user()->id }}">--}}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
