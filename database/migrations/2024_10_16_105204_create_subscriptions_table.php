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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('package_type', ['text-torrent', 'own-gateway'])->nullable();
            $table->string('package_name')->nullable();
            $table->double('amount', 20,2)->default(0);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->string('stripe_transaction_id', 2048)->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('credits')->default(0);
            $table->integer('sub_accounts')->default(0);
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
