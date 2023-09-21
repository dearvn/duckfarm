<?php

use App\Models\Tool\Warehouse;
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
        Schema::create('warehouse_bins', function (Blueprint $table) {
            $table->id();
            $table->string("name")->index();
            $table->string("internal_id")->nullable();
            $table->string("description")->nullable();
            $table->integer("capacity")->nullable();
            $table->string("unit")->nullable();
            $table->foreignIdFor(Warehouse::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_bins');
    }
};
