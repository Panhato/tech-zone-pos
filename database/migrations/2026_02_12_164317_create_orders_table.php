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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable(); // ទុកសម្រាប់ User Login
        $table->string('customer_name');      // ឈ្មោះអតិថិជន
        $table->string('customer_phone');     // លេខទូរស័ព្ទ (បន្ថែមថ្មី)
        $table->text('customer_address');     // អាសយដ្ឋាន (បន្ថែមថ្មី)
        $table->decimal('total_price', 10, 2);
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
