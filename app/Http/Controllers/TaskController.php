<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $task)
    {
        return Task::create([
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
        // $request->validate([
        //     'taskname' => 'required|max:255',
        // ]);

        // Task::create($request->post());
        $validator = Validator::make($request->all(), [
            'taskname' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/home')->withInput()->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->taskname;
        $task->save();
        // $check = $this->create($task);
        // $check->save();

        return redirect()->intended('home')->with('success', 'Task saved');
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

        return view('home',compact('tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('modals.edit_task', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // $task = Task::findOrFail($id);
        return redirect()->intended('home')->withSuccess(__('Task updated'));
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
