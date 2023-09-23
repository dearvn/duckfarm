<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        "warehouse_id",
        'created_by',
        'updated_by'
    ];

    public function inventory_logs(): HasMany
    {
        return $this->hasMany(InventoryLog::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function inventory_type(): BelongsTo
    {
        return $this->belongsTo(InventoryType::class, 'type');
    }
}
