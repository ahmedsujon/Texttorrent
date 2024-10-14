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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id')->nullable();
            $table->unsignedBigInteger('sender')->nullable();
            $table->unsignedBigInteger('receiver')->nullable();
            $table->longText('message')->nullable();
            $table->string('file', 2048)->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_name')->nullable();
            $table->tinyInteger('seen')->default(0);
            $table->string('msg_sid', 2048)->nullable();
            $table->string('api')->nullable();
            $table->enum('api_send_status', ['success', 'failed'])->default('success');
            $table->longText('api_send_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
