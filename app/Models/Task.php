<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'status',
        'content',
        'user_id',
        'file_id',  
        'is_published',
        'parent_id'
    ];


    /**
 * Get the file attached to the task.
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function file() : BelongsTo
    {
        return $this->belongsTo(File::class);
    }
    
}
