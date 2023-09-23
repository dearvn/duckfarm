<?php

namespace App\Models\Livestock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalMeasurement extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'animal_measurements';

    protected $fillable = [
        "weight",
        "height",
        "condition_score",
        "temp",
        "fec",
        "date",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        "date" => "date"
    ];
}
