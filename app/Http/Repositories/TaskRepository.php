<?php

namespace App\Http\Repositories;


use App\Models\Task;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(array $data, int $userId, ?int $fileId, ?int $parentId): Task
    {
        return Task::create([
            'title' => $data['title'],
            'status' => $data['status'],
            'content' => $data['content'],
            'user_id' => $userId,
            'file_id' => $fileId,
            'parent_id' => $parentId,
            'is_published' => $data['is_published'] == 0 ? false : true,
        ]);
    }

    public function updateTask(array $data, Task $task, ?int $fileId): bool
    {
        return $task->update([
            'title' => $data['title'],
            'status' => $data['status'],
            'content' => $data['content'],
            'file_id' => $fileId,
            'is_published' => $data['is_published'] == 0 ? false : true,
        ]);
    }

    public function filterTask(array $filter) : LengthAwarePaginator
    {
        $query = Task::select('id', 'title', 'content', 'status', 'file_id', 'created_at', 'is_published')
            ->with('file:id,name,path');
        if (!empty($filter['user_id'])) {
            $query->where('user_id', $filter['user_id']);
        }

        if (!empty($filter['date'])) {
            $query->whereDate('created_at', $filter['date']);
        }

        if (!empty($filter['status'])) {
            $query->where('status', $filter['status']);
        }
    
        if (!empty($filter['search'])) {
            $query->where('title', 'like', '%' . $filter['search'] . '%');
        }

        if (!empty($filter['order_by'])) {
            $query = $this->filterTaskOrderBy(orderBy: $filter['order_by'], query: $query);
        }

        if(!empty($filter['parent_id'])) {
            $query->where('parent_id', $filter['parent_id']);
        } else {
            $query->whereNull('parent_id');
        }

        return $query->paginate($filter['page_limit']);
    }

    /**
     * Apply ordering to the task query based on the specified order key.
     *
     * @param string $orderBy
     *     The order key, one of:
     *     - 'title_asc'         -> order by title ascending
     *     - 'title_desc'        -> order by title descending
     *     - 'created_at_asc'    -> order by creation date ascending
     *     - 'created_at_desc'   -> order by creation date descending
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *     The Eloquent query builder instance for tasks.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     *     The modified query builder with the applied ordering.
     */

    private function filterTaskOrderBy(string $orderBy, $query) : Builder
    {
        if($orderBy === 'title_asc') {
            $query->orderBy('title', 'ASC');
        } else if($orderBy === 'title_desc') {
            $query->orderBy('title', 'DESC');
        }else if($orderBy === 'created_at_asc') {
            $query->orderBy('created_at', 'ASC');
        }else if($orderBy === 'created_at_desc') {
            $query->orderBy('created_at', 'DESC');
        }

        return $query;
    }
}
