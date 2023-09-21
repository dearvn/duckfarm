<?php

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
        Schema::create('tool_inventories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("internal_id")->nullable();
            $table->string("unit")->nullable();
            $table->decimal("unit_value",8,2)->nullable();
            $table->string("unit_weight")->nullable();
            $table->string("track_lots")->nullable();
            $table->string("alert_amount")->nullable();
            $table->string("alert_email")->nullable();
            $table->string("description")->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_inventories');
    }
};
