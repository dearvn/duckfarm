<?php

namespace App\Models\Planting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropType extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'crop_types';

    protected $fillable = [
        "name",
        "description",
        'created_by',
        'updated_by'
    ];
}
