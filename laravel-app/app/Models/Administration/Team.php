<?php

namespace App\Models\Administration;

use App\Models\Accounting\Transaction;
use App\Models\Livestock\Animal;
use App\Models\Livestock\AnimalType;
use App\Models\Livestock\Group;
use App\Models\Tool\Equipment;
use App\Models\Tool\Inventory;
use App\Models\Tool\InventoryType;
use App\Models\Tool\Warehouse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Permission\Models\Role;

class Team extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string
     */
    protected $table = 'teams';

    protected $fillable = [
        'active',
        'name',
        'contact_name',
        'contact_phone',
        'contact_email',
        'admin_id',
        'balance',
        'credit',
        'description',
        'created_by',
        'updated_by'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(TeamAddress::class, 'addressable');
    }

    public function tasks(): HasOne
    {
        return $this->hasOne(Task::class);
    }

    public function contacts(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function transactions(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function animals(): HasOne
    {
        return $this->hasOne(Animal::class);
    }

    public function groups(): HasOne
    {
        return $this->hasOne(Group::class);
    }

    public function warehouses(): HasOne
    {
        return $this->hasOne(Warehouse::class);
    }

    public function inventories(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    public function inventoryTypes(): HasOne
    {
        return $this->hasOne(InventoryType::class);
    }

    public function equipments(): HasOne
    {
        return $this->hasOne(Equipment::class);
    }

    public function animalTypes(): HasOne
    {
        return $this->hasOne(AnimalType::class);
    }

    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function roles(): HasOne
    {
        return $this->hasOne(Role::class);
    }

}
