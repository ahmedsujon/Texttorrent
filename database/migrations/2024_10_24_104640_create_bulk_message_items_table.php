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
        Schema::create('bulk_message_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bulk_message_id')->nullable();
            $table->string('send_from')->nullable();
            $table->string('send_to')->nullable();
            $table->longText('message')->nullable();
            $table->longText('received_message')->nullable();
            $table->string('file', 2048)->nullable();
            $table->string('type')->nullable();
            $table->timestamp('execute_at')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_message_items');
    }
};
