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
        Schema::table('seller_accounts', function (Blueprint $table) {
            $table->string('orange_money_enable')->default(0);
            $table->string('orange_money_idType')->nullable();
            $table->bigInteger('orange_money_id')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_accounts', function (Blueprint $table) {
            $table->dropColumn('orange_money_enable');
            $table->dropColumn('orange_money_idType');
            $table->dropColumn('orange_money_id');
        });
    }
};
