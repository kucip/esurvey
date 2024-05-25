<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('menuId');
            $table->integer('compId');
            $table->string('menuNama', 100);
            $table->string('menuRoute', 100)->nullable();
            $table->string('menuIcon', 100)->nullable();
            $table->integer('menuParent')->nullable();
            $table->integer('menuOrder')->nullable();
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
        Schema::dropIfExists('menu');
    }
}
