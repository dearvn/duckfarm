<?php

namespace App\Models\Livestock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'livestock_groups';

    protected $fillable = [
        "name",
        "type",
        "active_only",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'active_only' => 'boolean',
    ];

}
