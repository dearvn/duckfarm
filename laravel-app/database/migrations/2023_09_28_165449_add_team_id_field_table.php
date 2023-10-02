<?php

use App\Models\Livestock\Animal;
use App\Models\Team;
use App\Models\Tool\InventoryItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('livestock_animals', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('animal_types', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });
        
        Schema::table('livestock_groups', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('tool_warehouses', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('tool_equipments', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('tool_inventories', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });

        Schema::table('inventory_types', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->cascadeOnDelete();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
