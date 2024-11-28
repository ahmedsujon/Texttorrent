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
        Schema::table('number_validations', function (Blueprint $table) {
            $table->integer('valid_numbers')->nullable()->after('total_landline_numbers');
            $table->integer('invalid_numbers')->nullable()->after('valid_numbers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('number_validations', function (Blueprint $table) {
            //
        });
    }
};
