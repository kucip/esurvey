<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Master\Pendidikan;
use \App\Models\Master\Agama;

class PendidikandanagamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pendidikan
        $pen = [
            ['pendNama' => 'Tidak / Belum Sekolah'],
            ['pendNama' => 'Belum Tamat SD / Sederajat'],
            ['pendNama' => 'SD / Sederajat'],
            ['pendNama' => 'SLTP / Sederajat'],
            ['pendNama' => 'SLTA / Sederajat'],
            ['pendNama' => 'Akademi / Diploma II / Sarjana Muda'],
            ['pendNama' => 'Diploma IV / Strata I'],
            ['pendNama' => 'S2'],
            ['pendNama' => 'S3'],
        ];

        Pendidikan::insert($pen);


        //Agama
        $agm = [
            ['agamaNama' => 'Islam'],
            ['agamaNama' => 'Kristen'],
            ['agamaNama' => 'Katolik'],
            ['agamaNama' => 'Hindu'],
            ['agamaNama' => 'Budha'],
            ['agamaNama' => 'Kong Hu Chu'],
            ['agamaNama' => 'Aliran Kepercayaan Lain'],
        ];

        Agama::insert($agm);

    }
}
