<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'addresses';

    public function contacts()
    {
        return $this->morphedByMany(Contact::class, 'addressable');
    }
}
