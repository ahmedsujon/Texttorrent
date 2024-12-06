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
        Schema::table('number_validation_items', function (Blueprint $table) {
            $table->string('location')->nullable()->after('number');
            $table->string('carrier')->nullable()->after('location');
            $table->string('line_type')->nullable()->after('carrier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('number_validation_items', function (Blueprint $table) {
            //
        });
    }
};
