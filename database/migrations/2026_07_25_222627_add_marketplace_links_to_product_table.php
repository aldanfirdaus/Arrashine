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
        Schema::table('product', function (Blueprint $table) {
            $table->string('shopee_link')->nullable()->after('image');
            $table->string('tokopedia_link')->nullable()->after('shopee_link');
            $table->string('tiktokshop_link')->nullable()->after('tokopedia_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn([
                'shopee_link',
                'tokopedia_link',
                'tiktokshop_link'
            ]);
        });
    }
};
