<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $reviewsTable = strval(config("sparkcommerce.table_prefix")).strval(config("sparkcommerce.product_reviews_table_name"));
        Schema::table( $reviewsTable, function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id');
        });
    }

    public function down()
    {
        $reviewsTable = strval(config("sparkcommerce.table_prefix")).strval(config("sparkcommerce.product_reviews_table_name"));
        Schema::table( $reviewsTable, function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });
    }
};
