<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $ordersTableName = strval(config("sparkcommerce.table_prefix")) . strval(config("sparkcommerce.orders_table_name"));
        Schema::table($ordersTableName, function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id');
        });
    }

    public function down()
    {
        $ordersTableName = strval(config("sparkcommerce.table_prefix")) . strval(config("sparkcommerce.orders_table_name"));
        Schema::table($ordersTableName, function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });
    }
};
