<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCymbalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cymbals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('collection_id');
            $table->integer('parent_id');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->double('price');
            $table->integer('order');
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
        Schema::dropIfExists('cymbals');
    }
}
