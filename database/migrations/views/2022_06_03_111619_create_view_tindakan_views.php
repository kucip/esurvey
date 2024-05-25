<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;


class CreateViewTindakanViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'select `trrawattindakan`.`tindakMsId` AS `tindakMsId`,
               `trrawattindakan`.`tindakTindakan` AS `tindakTindakan`,
               count(0) AS `jumlah`
        from `trrawattindakan`
        where (`trrawattindakan`.`tindakMsId` not in ("4444", "3890", "3989", "3889"))
        group by `trrawattindakan`.`tindakMsId`
        having (`jumlah` > 0)
        order by count(0) desc
        limit 20;
        ';

        Schema::createOrReplaceView('view_tindakan', $query);

    }
}
