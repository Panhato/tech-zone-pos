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
    Schema::create('stock_transactions', function (Blueprint $table) {
        $table->id();
        // សម្គាល់ទៅលើទំនិញណា
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        // ចំនួនដែលបានធ្វើប្រតិបត្តិការ
        $table->integer('quantity');
        // ប្រភេទប្រតិបត្តិការ៖ ចូល, ចេញ, ផ្ទេរ, ខូច
        $table->enum('type', ['in', 'out', 'transfer', 'broken']); 
        // មូលហេតុ ឬចំណាំផ្សេងៗ
        $table->text('note')->nullable();
        // អ្នកណាជាអ្នកធ្វើប្រតិបត្តិការនេះ
        $table->foreignId('user_id')->constrained();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
