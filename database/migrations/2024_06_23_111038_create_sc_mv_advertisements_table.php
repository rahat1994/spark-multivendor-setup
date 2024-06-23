<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(strval(config("sparkcommerce-multivendor.table_prefix")) . 'advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->string('status')->default('active');
            $table->string('position')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(strval(config("sparkcommerce-multivendor.table_prefix")) . 'advertisements');
    }
};
