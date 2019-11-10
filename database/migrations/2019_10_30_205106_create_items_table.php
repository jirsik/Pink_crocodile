<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('estimated_price')->nullable();
            $table->string('currency')->nullable();
            $table->unsignedBigInteger('doner_id')->nullable();
            // $table->string('photo_path')->default('images/item_placeholder.png');
            // $table->integer('itemable_id')->unique()->nullable();
            $table->string('item_photo_path')->nullable();
            $table->integer('itemable_id')->nullable();
            $table->string('itemable_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
