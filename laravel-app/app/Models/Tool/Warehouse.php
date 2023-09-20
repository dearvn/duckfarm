<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'tool_warehouses';

    protected $fillable = [
        "name",
        "internal_id",
        "description",
        'created_by',
        'updated_by'
    ];
    
}
