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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('full_name')->virtualAs(
                config('database.default') === 'sqlite'
                    ? "first_name  || ' ' || last_name"
                    : "CONCAT(first_name, ' ', last_name)"
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
