<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create( strval(config("sparkcommerce-multivendor.table_prefix")).'payment_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->decimal('amount', 8, 2);
            $table->string('status')->default('pending');
            $table->json('bank_info')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(strval(config("sparkcommerce-multivendor.table_prefix")).'payment_requests');
    }
};
