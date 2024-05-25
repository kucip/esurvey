<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Master\Kelurahan;
use \App\Models\Master\Kecamatan;
use \App\Models\Master\Kabupaten;
use \App\Models\Master\Provinsi;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kel = [
            ['kelId' => 60615, 'kelKec' => '110101', 'kelKode' => '1101012001', 'kelNama' => 'Keude Bakongan'],
            ['kelId' => 60616, 'kelKec' => '110101', 'kelKode' => '1101012002', 'kelNama' => 'Ujong Mangki'],
            ['kelId' => 60617, 'kelKec' => '110101', 'kelKode' => '1101012003', 'kelNama' => 'Ujong Padang'],
            ['kelId' => 60618, 'kelKec' => '110101', 'kelKode' => '1101012004', 'kelNama' => 'Gampong Drien'],
            ['kelId' => 60619, 'kelKec' => '110101', 'kelKode' => '1101012015', 'kelNama' => 'Darul Ikhsan'],
        ];

        Kelurahan::insert($kel);

        $kec = [
            ['kecId' => 1, 'kecKab' => '1101', 'kecKode' => '11010101', 'kecNama' => 'Bakongan'],
            ['kecId' => 2, 'kecKab' => '1101', 'kecKode' => '11010102', 'kecNama' => 'Kluet Utara'],
            ['kecId' => 3, 'kecKab' => '1101', 'kecKode' => '11010103', 'kecNama' => 'Kluet Selatan'],
            ['kecId' => 4, 'kecKab' => '1101', 'kecKode' => '11010104', 'kecNama' => 'Labuhan Haji'],
            ['kecId' => 5, 'kecKab' => '1101', 'kecKode' => '11010105', 'kecNama' => 'Meukek'],
        ];

        Kecamatan::insert($kec);

        $kab = [
            ['kabId' => 1, 'kabProv' => '11', 'kabKode' => '1101', 'kabNama' => 'Kab. Aceh Selatan'],
            ['kabId' => 2, 'kabProv' => '11', 'kabKode' => '1102', 'kabNama' => 'Kab. Aceh Tenggara'],
            ['kabId' => 3, 'kabProv' => '11', 'kabKode' => '1103', 'kabNama' => 'Kab. Aceh Timur'],
            ['kabId' => 4, 'kabProv' => '11', 'kabKode' => '1104', 'kabNama' => 'Kab. Aceh Tengah'],
            ['kabId' => 5, 'kabProv' => '11', 'kabKode' => '1105', 'kabNama' => 'Kab. Aceh Barat'],
        ];

        Kabupaten::insert($kab);

        $prov = [
            ['provId' => 1, 'provKode' => '11', 'provNama' => 'Aceh'],
            ['provId' => 2, 'provKode' => '12', 'provNama' => 'Sumatera Utara'],
            ['provId' => 3, 'provKode' => '13', 'provNama' => 'Sumatera Barat'],
            ['provId' => 4, 'provKode' => '14', 'provNama' => 'Riau'],
            ['provId' => 5, 'provKode' => '15', 'provNama' => 'Jambi'],
        ];

        Provinsi::insert($prov);



    }
}
