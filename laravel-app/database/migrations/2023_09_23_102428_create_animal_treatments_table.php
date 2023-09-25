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
        Schema::create('animal_treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animal::class);
            $table->string("type")->nullable();
            $table->string("product")->nullable();
            $table->string("batch")->nullable();
            $table->decimal("amount", 8, 2)->nullable();
            $table->string("location_id")->nullable();
            $table->decimal("inventory_amount", 8, 2)->nullable();
            $table->string("unit")->nullable();
            $table->string( "mode")->nullable();
            $table->string("site")->nullable();
            $table->integer( "days_to_withdrawal")->nullable();
            $table->date("retreat_date")->nullable();
            $table->string("technician")->nullable();
            $table->decimal("cost", 8, 2)->nullable();
            $table->string("record_transaction")->nullable();
            $table->date("date")->nullable();
            $table->json("keywords")->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('animal_treatments');
    }
};
