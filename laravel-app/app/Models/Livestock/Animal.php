<?php

namespace App\Models\Livestock;

use App\Models\BaseModel;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Animal extends BaseModel
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
        "amount",
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

    public function animal_father(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'father');
    }
    
    public function animal_mother(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'mother');
    }

    public function purchased_from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'purchased_from_id');
    }
    
    public function breeder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'breeder_id');
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function animal_notes(): HasMany
    {
        return $this->hasMany(AnimalNote::class);
    }

    public function animal_treatments(): HasMany
    {
        return $this->hasMany(AnimalTreatment::class);
    }

    public function animal_inputs(): HasMany
    {
        return $this->hasMany(AnimalInput::class);
    }

    public function animal_feedings(): HasMany
    {
        return $this->hasMany(AnimalFeeding::class);
    }

    public function animal_measurements(): HasMany
    {
        return $this->hasMany(AnimalMeasurement::class);
    }

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->birth_date)->age,
        );
    }
}
