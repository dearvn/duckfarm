
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
        Schema::create('livestock_animals', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("breed")->nullable();
            $table->string("gender")->nullable();
            $table->string("keywords")->nullable();
            $table->string("internal_id")->nullable();
            $table->string("status")->nullable();
            $table->string("death_date")->nullable();
            $table->string("deceased_reason")->nullable();
            $table->string("sale_date")->nullable();
            $table->boolean("is_neutered")->nullable();
            $table->string("breeding_stock")->nullable();
            $table->string("coloring")->nullable();
            $table->string("retention_score")->nullable();
            $table->string("description")->nullable();
            $table->string("tag_number")->nullable();
            $table->string("tag_color")->nullable();
            $table->string("tag_location")->nullable();
            $table->string("other_tag_number")->nullable();
            $table->string("other_tag_color")->nullable();
            $table->string("other_tag_location")->nullable();
            $table->string("electronic_id")->nullable();
            $table->string("registry_number")->nullable();
            $table->string("tattoo_left")->nullable();
            $table->string("tattoo_right")->nullable();
            $table->date("birth_date")->nullable();
            $table->string("mother")->nullable();
            $table->string("father")->nullable();
            $table->string("birth_weight")->nullable();
            $table->string("days_to_wean")->nullable();
            $table->string("weaned_date")->nullable();
            $table->string("purchased")->nullable();
            $table->date("purchase_date")->nullable();
            $table->string("purchase_price")->nullable();
            $table->string("record_purchase")->nullable();
            $table->string("purchased_from_id")->nullable();
            $table->string("breeder_id")->nullable();
            $table->string("contact_id")->nullable();
            $table->string("on_feed")->nullable();
            $table->string("feed")->nullable();
            $table->string("harvest_unit")->nullable();
            $table->decimal("market_price", 8, 2)->nullable();
            $table->decimal("estimated_value", 8, 2)->nullable();
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
        Schema::dropIfExists('livestock_animals');
    }
};
