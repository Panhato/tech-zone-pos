<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        // Add supplier_id column (nullable allows existing products to have no supplier)
        $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['supplier_id']);
        $table->dropColumn('supplier_id');
    });
}
};
