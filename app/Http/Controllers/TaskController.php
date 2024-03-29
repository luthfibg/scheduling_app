<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(view('home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $task, Request $request)
    {
        return Task::create($request->all() + [
            'name' => $task['name'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'taskname' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response(redirect('/home')->withInput()->withErrors($validator));
        }

        $task = new Task;
        $task->name = $request->taskname;
        $request->merge(['name' => $task->name]);
        $task->save();

        return response(redirect()->intended('home')->with('success', 'Task saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return response(view('home', compact('tasks')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return response(view('modals.edit_task', compact('task')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $task = Task::findOrFail($id);
        $task->name = $request->taskedit;
        $task->save();

        return redirect()->intended('home')->withSuccess(__('Task Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->intended('home')->withSuccess(__('Task deleted'));
    }
}