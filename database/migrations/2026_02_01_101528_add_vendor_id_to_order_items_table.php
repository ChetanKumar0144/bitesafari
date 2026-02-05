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
    Schema::table('order_items', function (Blueprint $table) {
        $table->foreignId('vendor_id')
              ->nullable()
              ->constrained('vendors')
              ->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['vendor_id']);
        $table->dropColumn('vendor_id');
    });
}
};
