<?php

namespace App\Models\Plant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'crop_types';

    protected $fillable = [
        "plant_type",
        "plant_variety",
        "internal_id",
        "icon",
        "weeks_before_frost",
        "days_to_emerge",
        "spacing",
        "row_spacing",
        "planting_depth",
        "planting_method",
        "estimated_germination_rate",
        "seeds_per_hole",
        "light_profile",
        "description",
        "is_perennial",
        "days_to_maturity",
        "harvest_window",
        "loss_rate",
        "harvest_unit",
        "market_price",
        "yield_per_100_ft",
        "yield_per_area",
        'created_by',
        'updated_by'
    ];    
}
