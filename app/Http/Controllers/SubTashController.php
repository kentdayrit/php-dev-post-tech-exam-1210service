<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Services\TaskService;
use App\Models\Task;


class SubTashController extends Controller
{
    public function __construct(
        protected readonly TaskService $taskService
    )
    {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        return view('pages.subtask.create')->with([
            'task' => $task
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Task $task)
    {
        $this->taskService->createTask(data: $request->validated(), parentId: $task->id);

        return redirect()->route('task.show',['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task, Task $sub)
    {
        $this->authorize('view', $sub);
        
        return view('pages.subtask.show')->with([
            'task' => $sub,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, Task $sub)
    {
        $this->authorize('view', $sub);

        return view('pages.subtask.edit')->with([
            'task' => $task,
            'sub' => $sub
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task, Task $sub)
    {
        $this->taskService->updateTask(data: $request->validated(), task: $sub);

        return redirect()->route('task.show',['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, Task $sub)
    {
        $sub->delete();

        return redirect()->route('task.show',['task' => $task->id]);
    }


}
