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
        Schema::create('animal_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animal::class);
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->json("attachments")->nullable();
            $table->date("date")->nullable();
            $table->string("category")->nullable();
            $table->string("assigned_to_id")->nullable();
            $table->json("keywords")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('animal_notes');
    }
};
