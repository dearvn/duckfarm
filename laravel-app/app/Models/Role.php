<?php

namespace App\Models;

use App\Models\Administration\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Database\Eloquent\Builder;

class Role extends ModelsRole
{
    use HasFactory;

    protected static function booted(): void
    {
        if (auth()->check() && auth()->id() != 1) {
            static::addGlobalScope('team', function (Builder $query) {
                $query->where('team_id', auth()->user()->team_id);
            });
        }
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
