@extends('layouts.app')

@section('content')

<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
    
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
          <div class="h-96 rounded-lg border-4 border-dashed border-gray-200"></div>
        </div>
        <!-- /End replace -->
      </div>
    </main>
</div>


{{-- Divider --}}


<div class="container">
    <div class="row justify-content-center px-md-5 mb-3">
        <div class="col-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ __(' You are logged in!') }}
            </div>
            <div class="card">
                <div class="card-header">{{ __('New Task') }}</div>

                <div class="card-body">                       
                    <form action="{{ route('tasks.save') }}" method="POST" class="mt-3 form-inline needs-validation" novalidate>
                        @csrf
                        <div class="col-12">
                            {{-- <label for="input_task" class="col-12 form-label mb-2 hidden">Task Name</label> --}}
                            <div class="col-12 col-md-8 col-lg-6 mb-3">
                                <input type="text" name="taskname" class="form-control" id="input_task" placeholder="Task Name" autocomplete="off">
                                <div class="invalid-feedback">
                                    {{ __('Please provide the task name') }}
                                </div>
                            </div>
                            {{-- <label for="input_task" class="col-12 form-label mb-2 hidden">Description</label> --}}
                            <div class="col-12 col-md-8 col-lg-6 mb-2">
                                <input type="text" name="description" class="form-control" id="input_desc" placeholder="Description" autocomplete="off">
                                <div class="invalid-feedback">
                                    {{ __('Please type description for task') }}
                                </div>
                            </div>
                            <label for="input_task" class="col-12 form-label">{{ __('Deadline') }}</label>
                            <div class="col-12 col-md-8 col-lg-6 mb-2">
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="date" class="form-control" id="input_date">
                                </div>
                                <div class="invalid-feedback">
                                    {{ __('Please pick a date to specify the deadline') }}
                                </div>
                            </div>
                        </div>
                        @include('common.errors')
                        <div class="form-group mt-3">
                            <div class="col-sm-offset-3 col-6">
                                <button type="submit" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Save') }}&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center px-md-5">
        <div class="col-12">
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
        </div>
    </div>    
    <div class="row justify-content-center px-md-5 mb-3">
        <div class="col-12">
            @if ($tasks->count() > 0)
                <div class="card">
                    <div class="card-header">
                        {{ __('Current Task') }}
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped task-table">
                            <thead>
                                <th class="th-lg th-first">Task</th>
                                <th style="width: 10%" class="th-second">&nbsp;</th>
                                <th style="width: 10%" class="th-third">&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal-{{ $task->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="modal fade" id="editTaskModal-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h4 class="modal-title w-100 font-weight-bold">{{ __('Edit Task') }}</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                {{-- <span aria-hidden="true">&times;</span> --}}
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body mx-3">
                                                                <div class="md-form mb-5">
                                                                    <label data-error="wrong" data-success="right" for="taskedit" class="mb-2">{{ __('New Task Name') }}</label>
                                                                    <input type="text" id="taskedit" class="form-control validate" name="taskedit" value="{{ $task->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button class="btn btn-success btn-sm">&nbsp;&nbsp;{{ __('Update') }}&nbsp;&nbsp;</button>
                                                            </div>
                                                        </form>
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
