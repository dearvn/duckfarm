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
        Schema::create('farm_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->json('checklist_items')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('associated_to')->nullable();
            $table->string('task_color')->nullable();
            $table->integer('assigned_to')->nullable();
            $table->string('priority')->nullable();
            //$table->boolean('is_visible')->default(false);
            $table->date('due_date')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('repeats', 20)->nullable();
            $table->decimal('hours_spent', 8, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_tasks');
    }
};
