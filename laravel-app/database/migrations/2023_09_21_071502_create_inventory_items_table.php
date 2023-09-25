<?php

use App\Models\Tool\Inventory;
use App\Models\Tool\Warehouse;
use App\Models\Tool\WarehouseBin;
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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->decimal("amount", 8, 2);
            $table->date("log_date")->nullable();
            $table->string("source")->nullable();
            $table->text("reason")->nullable();
            $table->foreignIdFor(Warehouse::class)->nullable()->nullOnDelete();
            $table->foreignIdFor(WarehouseBin::class)->nullable()->nullOnDelete();
            $table->foreignIdFor(Inventory::class)->nullable()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
