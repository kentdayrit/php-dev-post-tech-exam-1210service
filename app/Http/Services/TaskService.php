<?php

namespace App\Http\Services;

use App\Http\Repositories\FileRepositoryInterface;
use App\Http\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TaskService
{   
    public function __construct(
        protected readonly TaskRepositoryInterface $taskRepository,
        protected readonly FileRepositoryInterface $fileRepository,
        protected readonly FileService $fileService
    )
    {}

    /**
     * Create a new task, optionally with an uploaded image.
     *
     * @param array $data
     *     Validated task creation data.
     *
     * @return \App\Models\Task
     *     The created task instance.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *     If the transaction fails.
     */
    public function createTask(array $data, ?int $parentId = null) : Task
    {
        DB::beginTransaction();
        try {
        

            if(isset($data['task_image'])) {
                $fileData = $this->fileService->uploadImage(image: $data['task_image']);
                $file = $this->fileRepository->createFile(data: $fileData);    
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();            
            $task = $this->taskRepository->createTask(
                data: $data, 
                userId: $user->id, 
                fileId: $file->id ?? null,
                parentId: $parentId ?? null
            );
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpException(
                500,
                'Something went wrong while creating the task.',
                $th
            );
        }
        return $task;
    }

    /**
     * Update an existing task, optionally uploading a new image.
     *
     * @param array $data
     *     Validated task update data.
     * @param \App\Models\Task $task
     *     The task instance to be updated.
     *
     * @return \App\Models\Task
     *     The updated task instance.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *     If the transaction fails.
     */
    public function updateTask(array $data, Task $task) : Task
    {
        DB::beginTransaction();
        try {
            if(isset($data['task_image'])) {
                $fileData = $this->fileService->uploadImage(image: $data['task_image']);
                $file = $this->fileRepository->createFile(data: $fileData);    
            }

            $this->taskRepository->updateTask(
                data: $data, 
                task: $task, 
                fileId: $file->id ?? $task->file_id
            );
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpException(
                500,
                'Something went wrong while updating the task.',
                $th
            );
        }

        return $task;
    }
}
