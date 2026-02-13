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
    Schema::table('products', function (Blueprint $table) {
        $table->integer('discount_percent')->nullable()->default(0)->after('price'); // បញ្ចុះប៉ុន្មានភាគរយ?
        $table->date('discount_end_date')->nullable()->after('discount_percent');    // ផុតកំណត់អង្កាល?
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['discount_percent', 'discount_end_date']);
    });
}
};
