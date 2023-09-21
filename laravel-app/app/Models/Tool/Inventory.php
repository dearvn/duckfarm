<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'tool_inventories';

    protected $fillable = [
        "name",
        "type",
        "internal_id",
        "unit",
        "unit_value",
        "unit_weight",
        "track_lots",
        "alert_amount",
        "alert_email",
        "description",
        'created_by',
        'updated_by'
    ];
}
