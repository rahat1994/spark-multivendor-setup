<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $productsTable = strval(config("sparkcommerce.table_prefix")).strval(config("sparkcommerce.products_table_name"));
        Schema::table( $productsTable, function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id');
        });
    }

    public function down()
    {
        $productsTable = strval(config("sparkcommerce.table_prefix")).strval(config("sparkcommerce.products_table_name"));
        Schema::table( $productsTable, function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });
    }
};
