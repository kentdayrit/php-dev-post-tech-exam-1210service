<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property string|null $status
 * @property string|null $content
 * @property int $user_id
 * @property int|null $file_id
 * @property bool|null $is_published
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\File|null $file
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $subtasks
 */
class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'status',
        'content',
        'user_id',
        'file_id',  
        'is_published',
        'parent_id'
    ];

    public function file() : BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function subtasks()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }
}
