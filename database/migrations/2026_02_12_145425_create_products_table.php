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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('brand')->nullable(); // បន្ថែម brand ឱ្យត្រូវនឹង Seeder
        $table->decimal('price', 10, 2);
        $table->integer('stock')->default(0); // បន្ថែម stock ឱ្យត្រូវនឹង Seeder
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    }); // <--- ត្រូវបិទសញ្ញានេះឱ្យត្រឹមត្រូវ
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};