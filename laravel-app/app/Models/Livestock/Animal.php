<?php

namespace App\Models\Livestock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'livestock_animals';

    protected $fillable = [
        "name",
        "type",
        "breed",
        "gender",
        "keywords",
        "internal_id",
        "status",
        "death_date",
        "deceased_reason",
        "sale_date",
        "is_neutered",
        "breeding_stock",
        "coloring",
        "retention_score",
        "description",
        "tag_number",
        "tag_color",
        "tag_location",
        "other_tag_number",
        "other_tag_color",
        "other_tag_location",
        "electronic_id",
        "registry_number",
        "tattoo_left",
        "tattoo_right",
        "birth_date",
        "mother",
        "father",
        "birth_weight",
        "days_to_wean",
        "weaned_date",
        "purchased",
        "purchase_date",
        "purchase_price",
        "record_purchase",
        "purchased_from_id",
        "breeder_id",
        "contact_id",
        "on_feed",
        "feed",
        "harvest_unit",
        "market_price",
        "estimated_value",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'keywords' => 'array',
        'is_neutered' => 'boolean'
    ];

    public function animal_type(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class, 'type');
    }
    
}
