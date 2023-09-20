<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    use HasFactory;

    protected $table = 'task_items';

    protected $fillable = [
        'name',
        'is_enable',
        'assigned_to'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_enable' => 'boolean',
    ];
}
