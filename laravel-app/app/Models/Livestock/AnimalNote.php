<?php

namespace App\Models\Livestock;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AnimalNote extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'animal_notes';

    protected $fillable = [
        "latitude",
        "longitude",
        "attachments",
        "date",
        "category",
        "assigned_to_id",
        "keywords",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        "date" => "date",
        //"attachments" => "json",
        "keywords" => "array"
    ];

    public function assigned_to(): BelongsTo
    {
        return $this->belongsTo(User::class, "assigned_to_id");
    }

    public function created_user(): BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
