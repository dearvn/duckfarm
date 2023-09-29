<?php

namespace App\Models\Tool;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends BaseModel
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'tool_equipments';

    protected $fillable = [
        "name",
        "type",
        "status",
        "brand",
        "model_number",
        "year",
        "plate_number",
        "serial_number",
        "engine",
        "transmission",
        "usage_unit",
        "manual_url",
        "purchased",
        "date_purchased",
        "amount",
        "insured",
        "description",
        'created_by',
        'updated_by'
    ];
}
