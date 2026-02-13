<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up() {
    Schema::table('users', function (Blueprint $table) {
        // 'super_admin' (អ្នកគ្រប់គ្រងធំ), 'admin' (អ្នកគ្រប់គ្រងវេបសាយ), 'user' (អតិថិជន)
        $table->string('role')->default('user'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
