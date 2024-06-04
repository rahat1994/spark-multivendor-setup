<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create( strval(config("sparkcommerce-multivendor.table_prefix")).'vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('category');
            $table->string('slug')->unique();
            $table->string('contact_number')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists(strval(config("sparkcommerce-multivendor.table_prefix")).'vendors');
    }
};
