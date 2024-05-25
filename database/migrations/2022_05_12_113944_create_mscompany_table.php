<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMscompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mscompany', function (Blueprint $table) {
            $table->increments('compId');
            $table->longtext('compLogo');
            $table->string('compNama', 100)->nullable();
            $table->string('compPemilik', 100)->nullable();
            $table->string('compDetail', 100)->nullable();
            $table->string('compLokasi', 200)->nullable();
            $table->string('compBpjsId')->nullable();
            $table->integer('compKategori')->nullable();
            $table->integer('compStatusMng')->nullable();
            $table->integer('compStatus')->nullable();
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
        Schema::dropIfExists('mscompany');
    }
}
