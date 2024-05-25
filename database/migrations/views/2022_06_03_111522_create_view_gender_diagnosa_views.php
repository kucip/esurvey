<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;


class CreateViewGenderDiagnosaViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'select `a`.`diagMsId` AS `diagMsId`,
               `b`.`msdiagKode`   AS `msdiagKode`,
               `a`.`diagDiagnosa` AS `diagDiagnosa`,
               `c`.`rawatGender`  AS `rawatGender`,
               count(0)           AS `jumlah`
        from ((`trrawatdiagnosa` `a` left join `msdiagnosa` `b`
               on ((`a`.`diagMsId` = `b`.`msdiagId`))) left join `trrawat` `c`
              on ((`a`.`diagRawatId` = `c`.`rawatId`)))
        where (`a`.`diagMsId` <> 0)
        group by `a`.`diagMsId`, `c`.`rawatGender`
        order by count(0) desc;
        ';

        Schema::createOrReplaceView('view_gender_diagnosa', $query);

    }
}
