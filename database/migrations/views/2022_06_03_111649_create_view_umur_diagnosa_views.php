<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;


class CreateViewUmurDiagnosaViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = '(select `c`.`msdiagKode` AS `kode`,
                concat(1)                    AS `no`,
                concat("umur < 1 tahun")     AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where (`b`.`rawatLahir` > (now() - interval 1 year))
         group by `a`.`diagMsId`, (`b`.`rawatLahir` >= (now() - interval 1 year))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(2)                    AS `no`,
                concat("umur 1-10 tahun")    AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 10 year)) and (`b`.`rawatLahir` < (now() - interval 1 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 10 year)) and (`b`.`rawatLahir` < (now() - interval 1 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(3)                    AS `no`,
                concat("umur 10-20 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 20 year)) and (`b`.`rawatLahir` < (now() - interval 10 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 20 year)) and (`b`.`rawatLahir` < (now() - interval 10 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(4)                    AS `no`,
                concat("umur 20-30 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 30 year)) and (`b`.`rawatLahir` < (now() - interval 20 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 30 year)) and (`b`.`rawatLahir` < (now() - interval 20 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(5)                    AS `no`,
                concat("umur 30-40 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 40 year)) and (`b`.`rawatLahir` < (now() - interval 30 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 40 year)) and (`b`.`rawatLahir` < (now() - interval 30 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(6)                    AS `no`,
                concat("umur 40-50 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 50 year)) and (`b`.`rawatLahir` < (now() - interval 40 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 50 year)) and (`b`.`rawatLahir` < (now() - interval 40 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(7)                    AS `no`,
                concat("umur 50-60 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 60 year)) and (`b`.`rawatLahir` < (now() - interval 50 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 60 year)) and (`b`.`rawatLahir` < (now() - interval 50 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(8)                    AS `no`,
                concat("umur 60-70 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 70 year)) and (`b`.`rawatLahir` < (now() - interval 60 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 70 year)) and (`b`.`rawatLahir` < (now() - interval 60 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(9)                    AS `no`,
                concat("umur 70-80 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 80 year)) and (`b`.`rawatLahir` < (now() - interval 70 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 80 year)) and (`b`.`rawatLahir` < (now() - interval 70 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(10)                   AS `no`,
                concat("umur 80-90 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 90 year)) and (`b`.`rawatLahir` < (now() - interval 80 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 90 year)) and (`b`.`rawatLahir` < (now() - interval 80 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(11)                   AS `no`,
                concat("umur 90-100 tahun")  AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 100 year)) and (`b`.`rawatLahir` < (now() - interval 90 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 100 year)) and (`b`.`rawatLahir` < (now() - interval 90 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20)
        union all
        (select `c`.`msdiagKode`             AS `kode`,
                concat(12)                   AS `no`,
                concat("umur > 100 tahun")   AS `ket`,
                left(`a`.`diagDiagnosa`, 30) AS `diagnosa`,
                count(0)                     AS `jumlah`
         from ((`trrawatdiagnosa` `a` left join `trrawat` `b`
                on ((`a`.`diagRawatId` = `b`.`rawatId`))) left join `msdiagnosa` `c`
               on ((`a`.`diagMsId` = `c`.`msdiagId`)))
         where ((`b`.`rawatLahir` >= (now() - interval 200 year)) and (`b`.`rawatLahir` < (now() - interval 100 year)))
         group by `a`.`diagMsId`,
                  ((`b`.`rawatLahir` >= (now() - interval 200 year)) and (`b`.`rawatLahir` < (now() - interval 100 year)))
         having (`jumlah` <> 0)
         order by count(0) desc
         limit 20);
         ';

        Schema::createOrReplaceView('view_umur_diagnosa', $query);

    }
}
