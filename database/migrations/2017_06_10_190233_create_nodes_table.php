<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->text('content');
            $table->integer('x');
            $table->integer('y');
            $table->string('category');
            $table->string('floor');
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
        Schema::drop('nodes');
    }
}
