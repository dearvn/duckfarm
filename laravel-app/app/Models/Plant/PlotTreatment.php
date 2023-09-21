<?php

namespace App\Models\Plant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotTreatment extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'crop_types';

    protected $fillable = [
        "type",
        "product",
        "batch",
        "amount",
        
        "name",
        "description",
        'created_by',
        'updated_by'
    ];
}
