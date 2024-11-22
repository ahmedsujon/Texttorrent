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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('alert_at')->nullable();
            $table->string('sender_number')->nullable();
            $table->string('receiver_number')->nullable();
            $table->string('alert_before')->nullable();
            $table->string('participant_number')->nullable();
            $table->string('participant_email')->nullable();
            $table->string('api')->nullable();
            $table->longText('send_response')->nullable();
            $table->text('msg_sid')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
