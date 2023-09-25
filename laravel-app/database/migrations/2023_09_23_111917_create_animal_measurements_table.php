<?php

use App\Models\Livestock\Animal;
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
        Schema::create('animal_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animal::class);
            $table->decimal("weight", 8, 2)->nullable();
            $table->decimal("height", 8, 2)->nullable();
            $table->decimal("condition_score", 8, 2)->nullable();
            $table->decimal("temp", 8, 2)->nullable();
            $table->decimal("fec", 8, 2)->nullable();
            $table->date("date")->nullable();
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
        Schema::dropIfExists('animal_measurements');
    }
};
