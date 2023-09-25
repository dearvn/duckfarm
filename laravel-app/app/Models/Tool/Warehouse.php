<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function bins(): HasMany
    {
        return $this->hasMany(WarehouseBin::class);
    }
    
    public function inventory_items(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }
}
