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
        // បន្ថែម column qty (ចំនួន) ជា integer និងអនុញ្ញាតឱ្យ null បាន (ដើម្បីកុំឱ្យ error ទិន្នន័យចាស់)
        $table->integer('qty')->default(0)->after('price'); 
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('qty');
    });
}
};
