<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        $couponsTable = strval(config("sparkcommerce.table_prefix")) . strval(config("sparkcommerce.coupons_table_name"));
        Schema::table($couponsTable, function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id');
        });
    }

    public function down()
    {
        $couponsTable = strval(config("sparkcommerce.table_prefix")) . strval(config("sparkcommerce.coupons_table_name"));
        Schema::table($couponsTable, function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });
    }
};
