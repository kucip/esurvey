<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class CreateViewKecamatanViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'select `a`.`rawatKec` AS `kode`, count(0) AS `jumlah`
        from `trrawat` `a`
        where ((`a`.`rawatKec` <> "") and (`a`.`rawatKec` <> 0) and (`a`.`rawatKec` <> 1) and (`a`.`rawatKec` <> 285))
        group by `a`.`rawatKec`
        having (`jumlah` <> 0)
        order by count(0) desc
        limit 20;
        ';

        Schema::createOrReplaceView('view_kecamatan', $query);

    }
}
