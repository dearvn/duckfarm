<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Contact extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'contacts';

    protected $fillable = [
        "first_name",
        "last_name",
        "full_name",
        "email",
        "contact_type",
        "keywords",
        "primary_phone",
        "mobile_phone",
        "fax",
        "company",
        "country",
        "address",
        "city",
        "state",
        "postal_code",
        "description",
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(ContactAddress::class, 'addressable');
    }
}
