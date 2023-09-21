<?php

namespace App\Models\Plant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotBed extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'plot_beds';

    protected $fillable = [
        "count",
        "length",
        "width",
        'created_by',
        'updated_by'
    ];
}
