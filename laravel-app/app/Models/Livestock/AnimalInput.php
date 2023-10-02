<?php

namespace App\Models\Livestock;

use App\Models\Tool\InventoryLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalInput extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'animal_inputs';

    protected $fillable = [
        "location_id",
        "amount",
        "unit",
        "type",
        "cost",
        "date",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        "date" => "date"
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function inventory_location(): BelongsTo
    {
        return $this->belongsTo(InventoryLocation::class, 'location_id', 'location_id');
    }
}
