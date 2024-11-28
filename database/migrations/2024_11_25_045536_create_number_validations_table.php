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
        Schema::create('number_validations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('list_id')->nullable();
            $table->longText('number_ids')->nullable();
            $table->integer('total_number')->default(0);
            $table->integer('total_credits')->default(0);
            $table->integer('total_mobile_numbers')->nullable();
            $table->integer('total_landline_numbers')->nullable();
            $table->integer('valid_numbers')->nullable();
            $table->integer('invalid_numbers')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_validations');
    }
};
