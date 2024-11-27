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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('list_id')->nullable();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('number')->nullable();
            $table->string('company')->nullable();
            $table->string('additional_1')->nullable();
            $table->string('additional_2')->nullable();
            $table->string('additional_3')->nullable();
            $table->enum('valid', ['Valid', 'Invalid'])->nullable();
            $table->tinyInteger('validation_process')->default(0);
            $table->tinyInteger('blacklisted')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
