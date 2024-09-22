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
            $table->string('full_name')->unique()->nullable();
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
            // DLC Registration Brand Registration
            $table->string('company_phone')->nullable();
            $table->string('company_website')->nullable();
            $table->string('industry')->nullable();
            $table->string('organization_type')->nullable();
            $table->string('country_of_registration')->nullable();
            $table->string('tax_number')->nullable();
            $table->boolean('share_legal_doc')->default(0);
            $table->string('city')->nullable();
            $table->string('street_address')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            // DLC Registration Campaign Registration
            $table->string('campaign_name')->nullable();
            $table->string('campaign_type')->nullable();
            $table->longText('campaign_description')->nullable();
            $table->longText('sample_message_one')->nullable();
            $table->longText('sample_message_two')->nullable();
            $table->boolean('opt_in')->default(0);
            $table->boolean('opt_out')->default(0);
            $table->boolean('direct_lending')->default(0);
            $table->boolean('embedded_link')->default(0);
            $table->boolean('embedded_phone')->default(0);
            $table->boolean('affiliate_marketing')->default(0);
            $table->string('age_gated_content')->nullable();
            $table->string('additional_recipients')->nullable();
            $table->boolean('terms_aggre')->default(0);
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
