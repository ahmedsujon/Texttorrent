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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar', 2048)->nullable();
            $table->string('company_name')->nullable();
            $table->string('voicemail_notify_email')->nullable();
            $table->enum('voicemail_message_type', ['text', 'file'])->default('text');
            $table->longText('greetings_text')->nullable();
            $table->string('greetings_file', 2048)->nullable();
            $table->string('timezone')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->default(0);
            $table->text('permissions')->nullable();
            $table->enum('type', ['main', 'sub'])->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
