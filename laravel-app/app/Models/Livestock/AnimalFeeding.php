<?php

namespace App\Models\Livestock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalFeeding extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'animal_feedings';

    protected $fillable = [
        "location_id",
        "amount",
        "unit",
        "type",
        "weight",
        "cost",
        "date",
        "repeat_until_date",
        "keywords",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        "repeat_until_date" => "date",
        "date" => "date"
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
