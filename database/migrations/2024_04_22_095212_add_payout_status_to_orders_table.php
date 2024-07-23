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
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payout_status', ['pending', 'complete'])->default('pending');
            $table->text('payout_description')->nullable();
            $table->string('payout_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payout_status');
            $table->dropColumn('payout_description');
            $table->dropColumn('payout_image');
        });
    }
};
