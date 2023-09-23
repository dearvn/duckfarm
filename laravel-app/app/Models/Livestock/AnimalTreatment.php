<?php

namespace App\Models\Livestock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalTreatment extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'animal_treatments';

    protected $fillable = [
        "type",
        "product",
        "batch",
        "amount",
        "location_id",
        "inventory_amount",
        "unit",
        "mode",
        "site",
        "days_to_withdrawal",
        "retreat_date",
        "technician",
        "cost",
        "record_transaction",
        "date",
        "keywords",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        "record_transaction" => "boolean",
        "retreat_date" => "date",
        "date" => "date"
    ];
}
