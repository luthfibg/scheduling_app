@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center px-md-5 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('New Task') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <form action="{{ route('tasks.save') }}" method="POST" class="mt-3 form-inline needs-validation" novalidate>
                        @csrf
                        <div class="col-12">
                            <label for="input_task" class="col-12 form-label mb-2">Task Name</label>
                            <div class="col-12 col-md-6 mb-2">
                                <input type="text" name="taskname" class="form-control" id="input_task">
                                <div class="invalid-feedback">
                                    Please provide the task name
                                </div>
                            </div>
                            <label for="input_task" class="col-12 form-label mb-2">Description</label>
                            <div class="col-12 col-md-6 mb-2">
                                <input type="text" name="description" class="form-control" id="input_desc">
                                <div class="invalid-feedback">
                                    Please type description for task
                                </div>
                            </div>
                            <label for="input_task" class="col-12 form-label mb-2">Deadline</label>
                            <div class="col-12 col-md-6 mb-2">
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="date" class="form-control" id="input_date">
                                </div>
                                <div class="invalid-feedback">
                                    Please pick a date to specify the deadline
                                </div>
                            </div>
                        </div>
                        @include('common.errors')
                        <div class="form-group mt-3">
                            <div class="col-sm-offset-3 col-6">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="card-footer">
                    2022
                </div> --}}
            </div>
        </div>
    </div>
    {{-- <div class="row row-cols-3 px-md-5 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>
                <div class="card-body">
                    {{ __('Task 1') }}
                </div>
            </div>
        </div>
    </div> --}}
    @if(Session::get('success', false))
        <?php $data = Session::get('success'); ?>
        @if (is_array($data))
            @foreach ($data as $msg)
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check"></i>
                    {{ $msg }}
                </div>
            @endforeach
        @else
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $data }}
            </div>
        @endif
    @endif
    <div class="row justify-content-center px-md-5 mb 3">
        <div class="col-12">
            @if ($tasks->count() > 0)
                <div class="card">
                    <div class="card-header">
                        Current Tasks
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped task-table">
                            <thead>
                                <th class="th-lg">Task</th>
                                <th style="width: 10%">&nbsp;</th>
                                <th style="width: 10%">&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h4 class="modal-title w-100 font-weight-bold">Edit Task</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                {{-- <span aria-hidden="true">&times;</span> --}}
                                                            </button>
                                                        </div>
                                                        <div class="modal-body mx-3">
                                                            <div class="md-form mb-5">
                                                                <label data-error="wrong" data-success="right" for="edit_task">New Task Name</label>
                                                                <input type="text" id="edit_task" class="form-control validate" name="edit_task" value="{{ $task->name }}">
                                                            </div>
                                                            {{-- <div class="md-form mb-4">
                                                                <i class="fas fa-lock prefix grey-text"></i>
                                                                <input type="password" id="defaultForm-pass" class="form-control validate">
                                                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                                                            </div> --}}
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                                @method('UPDATE')
                                                                @csrf
                                                                <button class="btn btn-success btn-sm">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
