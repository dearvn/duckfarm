<?php

namespace App\Models;

use App\Models\Livestock\Animal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Task extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'attachments',
        'checklist_items',
        'latitude',
        'longitude',
        'associated_to',
        'task_color',
        'assigned_to',
        'priority',
        'due_date',
        'status',
        'repeats',
        'hours_spent',
        'created_by',
        'updated_by'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'checklist_items' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'associated_to');
    }

    public function items(): HasMany
    {
        return $this->hasMany(TaskItem::class, 'task_id');
    }
}
