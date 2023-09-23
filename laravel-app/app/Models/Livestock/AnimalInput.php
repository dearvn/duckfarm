<?php

namespace App\Models\Livestock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
