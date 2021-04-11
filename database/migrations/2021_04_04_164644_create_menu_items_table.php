<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('href')->nullable();
            $table->string('icon')->nullable();
            $table->string('slug');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->unsignedBigInteger('menu_id')->unsigned();
            $table->integer('sequence');
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
