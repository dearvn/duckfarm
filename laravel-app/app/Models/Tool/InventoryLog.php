<?php

namespace App\Models\Tool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryLog extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'inventory_logs';

    protected $fillable = [
        "amount",
        "log_date",
        "source",
        "reason",
        "warehouse_bin_id",
        "inventory_id",
        "warehouse_id",
        'created_by',
        'updated_by'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'log_date' => 'date',
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }

    public function bin(): BelongsTo
    {
        return $this->belongsTo(WarehouseBin::class);
    }
}
