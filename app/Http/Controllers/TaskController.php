<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TaskRepository;
use App\Http\Repositories\TaskRepositoryInterface;
use App\Http\Requests\TaskRequest;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(
        protected readonly TaskRepositoryInterface $taskRepository,
        protected readonly TaskService $taskService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $filter['user_id'] = Auth::user()->id;
        $filter['page_limit'] = !empty($filter['page_limit']) ? $filter['page_limit'] : 10;    
        $filter['date'] = !empty($filter['date']) ? date('Y-m-d', strtotime($filter['date'])) : '';
        $filter['status'] =  !empty($filter['status']) ? $filter['status'] : null;
        $filter['order_by'] =  !empty($filter['order_by']) ? $filter['order_by'] : 'created_at_desc';

        return view('pages.task.index')->with([
            'filter' => $filter,
            'data' => $this->taskRepository->filterTask(filter: $filter),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->taskService->createTask(data: $request->validated());

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('pages.task.show')->with([
            'task' => $task,
            'subTask' => $this->taskRepository->filterTask(filter: [
                'order_by' => 'created_at_asc',
                'parent_id' => $task->id,
                'page_limit' => 10
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('view', $task);

        return view('pages.task.edit')->with([
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->taskService->updateTask(data: $request->validated(), task: $task);

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index');
    }
}
