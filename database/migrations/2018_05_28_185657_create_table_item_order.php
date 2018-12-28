<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableItemOrder extends Migration
{
    public function up()
    {
        Schema::create('item_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_order');
    }
}
