<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mime_type',
        'path',
        'size',
    ];

    /**
     * Get the task associated with the file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task() : HasOne
    {
        return $this->hasOne(Task::class);
    }
}
