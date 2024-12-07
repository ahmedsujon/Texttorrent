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
        Schema::create('bulk_message_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bulk_message_id')->nullable();
            $table->unsignedBigInteger('bulk_message_item_id')->nullable();
            $table->longText('message')->nullable();
            $table->string('msg_sid', 2048)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_message_replies');
    }
};
