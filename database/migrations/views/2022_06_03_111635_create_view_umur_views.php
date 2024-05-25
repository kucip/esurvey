<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;


class CreateViewUmurViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'select concat(1) AS `no`, concat("umur < 1 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where (`trrawat`.`rawatLahir` >= (now() - interval 1 year))
        union all
        select concat(2) AS `no`, concat("umur 1-10 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 10 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 1 year)))
        union all
        select concat(3) AS `no`, concat("umur 10-20 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 20 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 10 year)))
        union all
        select concat(4) AS `no`, concat("umur 20-30 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 30 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 20 year)))
        union all
        select concat(5) AS `no`, concat("umur 30-40 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 40 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 30 year)))
        union all
        select concat(6) AS `no`, concat("umur 40-50 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 50 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 40 year)))
        union all
        select concat(7) AS `no`, concat("umur 50-60 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 60 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 50 year)))
        union all
        select concat(8) AS `no`, concat("umur 60-70 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 70 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 60 year)))
        union all
        select concat(9) AS `no`, concat("umur 70-80 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 80 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 70 year)))
        union all
        select concat(10) AS `no`, concat("umur 80-90 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 90 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 80 year)))
        union all
        select concat(11) AS `no`, concat("umur 90-100 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where ((`trrawat`.`rawatLahir` >= (now() - interval 100 year)) and
               (`trrawat`.`rawatLahir` < (now() - interval 90 year)))
        union all
        select concat(12) AS `no`, concat("umur > 100 tahun") AS `ket`, count(0) AS `umur`
        from `trrawat`
        where (`trrawat`.`rawatLahir` < (now() - interval 100 year));
        ';

        Schema::createOrReplaceView('view_umur', $query);

    }
}
