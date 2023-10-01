<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TeamAddress extends Model
{
    use HasFactory;

    protected $table = 'team_addresses';

    protected $guarded = [];
    
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
