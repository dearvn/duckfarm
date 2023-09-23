<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'inventory_types';

    protected $fillable = [
        "name",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
    ];
}
