<?php

/**
* Created by Adnan Mauludin Fajriyadi
* "Peningkatan Relevansi Pencarian Produk Halal Dalam Aplikasi Halal Nutrition Food Menggunakan Algoritma OKAPI BM25F"
*
* April 2017
*/

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cert = [
            ['id'=>'2', 'cCode'=>'00100061230412', 'cExpire'=>'2016-06-17','cStatus'=>'New','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'3', 'cCode'=>'00100039300306', 'cExpire'=>'2016-07-09','cStatus'=>'New','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'4', 'cCode'=>'00290047180208', 'cExpire'=>'2018-06-01','cStatus'=>'Renew','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'5', 'cCode'=>'00100027970104', 'cExpire'=>'2018-09-03','cStatus'=>'Renew','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'6', 'cCode'=>'00250017010901', 'cExpire'=>'2017-04-08','cStatus'=>'Renew','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'7', 'cCode'=>'00040007670298', 'cExpire'=>'2017-03-02','cStatus'=>'Renew','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'8', 'cCode'=>'00120041860906', 'cExpire'=>'2018-02-17','cStatus'=>'Renew','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'9', 'cCode'=>'00120017110901', 'cExpire'=>'2016-09-03','cStatus'=>'Renew','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'15', 'cCode'=>'00100017571001', 'cExpire'=>'2016-07-01','cStatus'=>'Development','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'16', 'cCode'=>'00100039350306', 'cExpire'=>'2016-07-01','cStatus'=>'Development','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>'17', 'cCode'=>'0111003181102', 'cExpire'=>'2016-07-01','cStatus'=>'Development','cOrganization'=>'Majelis Ulama Indonesia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        // masukkan data ke database
        DB::table('certificates')->insert($cert);
    }
}
