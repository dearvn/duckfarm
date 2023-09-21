<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WarehouseBin extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'warehouse_bins';

    protected $fillable = [
        "name",
        "internal_id",
        "description",
        "capacity",
        "unit",
        "warehouse_id",
        'created_by',
        'updated_by'
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function inventory_logs(): HasMany
    {
        return $this->hasMany(InventoryLog::class);
    }
}
