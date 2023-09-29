<?php

namespace App\Models;

use App\Models\Accounting\Transaction;
use App\Models\Livestock\Animal;
use App\Models\Livestock\AnimalType;
use App\Models\Livestock\Group;
use App\Models\Tool\Equipment;
use App\Models\Tool\Inventory;
use App\Models\Tool\InventoryType;
use App\Models\Tool\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'address',
        'city',
        'state',
        'zip_code',
        'admin_id',
        'balance',
        'credit',
        'created_by',
        'updated_by'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

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
}
