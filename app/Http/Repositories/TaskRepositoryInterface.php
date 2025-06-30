<?php

namespace App\Http\Repositories;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    /**
     * Create a new task record in the database.
     *
     * @param array $data
     *     The validated task data (title, content, status, etc.).
     * @param int $userId
     *     The ID of the user creating the task.
     * @param int|null $fileId
     *     Optional file ID if an image or file is associated.
     *
     * @return \App\Models\Task
     *     The newly created task instance.
     */
    public function createTask(array $data, int $userId, ?int $fileId, ?int $parentId): Task;

    /**
     * Update an existing task with new data.
     *
     * @param array $data
     *     The updated task data.
     * @param \App\Models\Task $task
     *     The task instance to update.
     * @param int|null $fileId
     *     Optional new file ID.
     *
     * @return bool
     *     True if the update was successful, false otherwise.
     */
    public function updateTask(array $data, Task $task, ?int $fileId): bool;

    /**
     * Retrieve a paginated list of tasks filtered by various criteria.
     *
     * @param array $filter
     *     Supported keys:
     *     - 'user_id' (int|null)
     *     - 'date' (string|null, Y-m-d)
     *     - 'status' (string|null)
     *     - 'search' (string|null)
     *     - 'order_by' (string|null)
     *     - 'page_limit' (int|null)
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     *     Paginated list of filtered tasks.
     */
    public function filterTask(array $filter): LengthAwarePaginator;
}
