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
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        
        return view('pages.subtask.show')->with([
            'task' => $task,
        ]);
    }

}
