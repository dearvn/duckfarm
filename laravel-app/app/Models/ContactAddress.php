<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ContactAddress extends Model
{
    use HasFactory;

    protected $table = 'contact_addresses';

    protected $guarded = [];
    
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
