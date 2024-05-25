<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class CreateViewGenderViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'select concat(1) AS `nomor`,
               concat("Laki-Laki") AS `gender`,
               count(distinct `trrawat`.`rawatRm`) AS `jumlah`
        from `trrawat`
        where (`rawatGender` = 1)
        union all
        select concat(2) AS `nomor`,
               concat("Perempuan") AS `gender`,
               count(distinct `trrawat`.`rawatRm`) AS `jumlah`
        from `trrawat`
        where (`rawatGender` = 2);
        
        ';

        Schema::createOrReplaceView('view_gender', $query);

    }
}
