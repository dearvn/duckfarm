<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLocation extends Model
{
    use HasFactory;

    protected $table = 'inventory_locations';

    protected $fillable = [
        "inventory_name",
        "inventory_id",
        "warehouse_name",
        "warehouse_id",
        'bin_name',
        'bin_id',
        'amount',
        'unit',
        'input_amount',
        'feeding_amount',
        'treatment_amount'
    ];
}
