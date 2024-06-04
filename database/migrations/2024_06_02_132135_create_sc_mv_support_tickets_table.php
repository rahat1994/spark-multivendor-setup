<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create( strval(config("sparkcommerce-multivendor.table_prefix")).'support_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('contact_number')->nullable();
            $table->longText('description');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(strval(config("sparkcommerce-multivendor.table_prefix")).'support_tickets');
    }
};
