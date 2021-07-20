<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_stores', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->integer('platform_id');
            $table->string('link',256);
            $table->decimal('price',12,2);
            $table->decimal('origin_price',12,2);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platform_stores');
    }
}
