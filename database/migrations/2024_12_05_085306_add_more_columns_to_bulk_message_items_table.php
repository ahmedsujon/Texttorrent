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
        Schema::table('bulk_message_items', function (Blueprint $table) {
            $table->string('msg_sid', 2048)->nullable()->after('message');
            $table->string('send_status')->default('pending')->after('msg_sid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bulk_message_items', function (Blueprint $table) {
            //
        });
    }
};
