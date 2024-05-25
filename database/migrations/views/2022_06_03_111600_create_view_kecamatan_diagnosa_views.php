<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;


class CreateViewKecamatanDiagnosaViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'select `b`.`rawatKec` AS `rawatKec`,
               `c`.`msdiagKode`             AS `kode`,
               concat(1)                    AS `no`,
               left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
               count(0)                     AS `jumlah`
        from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
               on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
              on ((`a`.`diagMsId` = `c`.`msdiagId`)))
        where ((`b`.`rawatKec` <> "") and (`b`.`rawatKec` <> "0"))
        group by `b`.`rawatKec`, `a`.`diagMsId`
        having (`jumlah` <> 0)
        order by count(0) desc;
        ';

        Schema::createOrReplaceView('view_kecamatan_diagnosa', $query);

    }
}
