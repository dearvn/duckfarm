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
        Schema::create('tool_equipments', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("status")->nullable();
            $table->string("brand")->nullable();
            $table->string("model_number")->nullable();
            $table->integer("year")->nullable();
            $table->string("plate_number")->nullable();
            $table->string("serial_number")->nullable();
            $table->string("engine")->nullable();
            $table->string("transmission")->nullable();
            $table->string("usage_unit")->nullable();
            $table->string("manual_url")->nullable();
            $table->string("purchased")->nullable();
            $table->date("date_purchased")->nullable();
            $table->decimal("amount", 8, 2)->nullable();
            $table->string("insured")->nullable();
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_equipments');
    }
};
