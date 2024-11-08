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
        Schema::create('numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('purchased_by')->nullable();
            $table->string('friendly_name')->nullable();
            $table->string('number')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('capabilities')->nullable();
            $table->string('twilio_number_sid', 1024)->nullable();
            $table->string('twilio_service_sid', 1024)->nullable();
            $table->timestamp('purchased_at')->nullable();
            $table->enum('type', ['local', 'tollfree'])->default('local');
            $table->integer('webhook')->default(0);
            $table->date('next_renew_date')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numbers');
    }
};
