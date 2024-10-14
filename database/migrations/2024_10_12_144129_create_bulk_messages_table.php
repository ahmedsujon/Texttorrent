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
        Schema::create('bulk_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('contact_list_id')->nullable();
            $table->unsignedBigInteger('inbox_template_id')->nullable();
            $table->tinyInteger('number_pool')->default(0);
            $table->tinyInteger('batch_process')->default(0);
            $table->tinyInteger('opt_out_link')->default(0);
            $table->tinyInteger('round_robin_campaign')->default(0);
            $table->string('phone_numbers')->nullable();
            $table->string('sms_type')->nullable();
            $table->longText('sms_body')->nullable();
            $table->text('appended_message')->nullable();
            $table->string('batch_size')->nullable();
            $table->string('batch_frequency')->nullable();
            $table->string('sending_throttle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_messages');
    }
};
