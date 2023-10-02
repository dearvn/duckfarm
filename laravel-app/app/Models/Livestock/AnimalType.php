<?php

namespace App\Models\Livestock;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalType extends BaseModel
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'animal_types';

    protected $fillable = [
        "name",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
    ];

}
