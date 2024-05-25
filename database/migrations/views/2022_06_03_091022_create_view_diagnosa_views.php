<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;


class CreateViewDiagnosaViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $query = 'select a.diagMsId AS diagMsId,
               b.msdiagKode AS msdiagKode,
               a.diagDiagnosa AS diagDiagnosa,
               count(0) AS jumlah
        from (trrawatdiagnosa a left join msdiagnosa b
              on ((a.diagMsId = b.msdiagId)))
        where (a.diagMsId <> 0)
        group by a.diagMsId
        order by count(0) desc
        limit 12;';

        Schema::createOrReplaceView('view_diagnosa', $query);

    }
}
