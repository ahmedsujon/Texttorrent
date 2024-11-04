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
            $table->enum('direction', ['inbound', 'outbound'])->default('outbound');
            $table->longText('message')->nullable();
            $table->string('file', 2048)->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_name')->nullable();
            $table->tinyInteger('seen')->default(0);
            $table->string('msg_sid', 2048)->nullable();
            $table->string('api')->nullable();
            $table->string('api_send_status')->default('pending');
            $table->longText('api_send_response')->nullable();
            $table->enum('api_receive_status', ['success', 'failed'])->default('success');
            $table->longText('api_receive_response')->nullable();
            $table->tinyInteger('status')->default(0);
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
