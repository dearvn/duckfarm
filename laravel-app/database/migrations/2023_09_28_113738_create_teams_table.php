<?php

use App\Models\User;
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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(0);
            $table->decimal('credit', 8, 2)->index()->default(0);
            $table->decimal('balance', 8, 2)->index()->default(0);
            $table->foreignIdFor(User::class, 'admin_id')->nullable()->nullOnDelete();
            $table->foreignIdFor(User::class, 'created_by')->nullable()->nullOnDelete();
            $table->foreignIdFor(User::class, 'updated_by')->nullable()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
