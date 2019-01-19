<?php

/**
* Created by Adnan Mauludin Fajriyadi
* "Peningkatan Relevansi Pencarian Produk Halal Dalam Aplikasi Halal Nutrition Food Menggunakan Algoritma OKAPI BM25F"
*
* April 2017
*/

use Illuminate\Database\Seeder;

class ManufactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $man = [
            ['id'=>'100', 'name'=>'PT. Heinz ABC Indonesia'],
            ['id'=>'101', 'name'=>'PT. Buana Tirta Utama'],
            ['id'=>'102', 'name'=>'PT. Mayora Indah Tbk'],
            ['id'=>'103', 'name'=>'PT. Mega Global Food Industry'],
            ['id'=>'104', 'name'=>'PT. Ultra Prima Abadi'],
            ['id'=>'105', 'name'=>'PT. Monysaga Prima'],
            ['id'=>'106', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'107', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'108', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'13', 'name'=>'PT. Keong Nusantara Abadi'],
            ['id'=>'14', 'name'=>'PT. Ultrajaya Milk Industry'],
            ['id'=>'15', 'name'=>'PT. Tirta Alam Segar'],
            ['id'=>'16', 'name'=>'PT. Santos Jaya Abadi'],
            ['id'=>'17', 'name'=>'PT. Dua Kelinci'],
            ['id'=>'18', 'name'=>'PT. YHS Indonesia'],
            ['id'=>'19', 'name'=>'PT. Dalya Citramandiri'],
            ['id'=>'2', 'name'=>'PT. Sinar Kencana Agung'],
            ['id'=>'20', 'name'=>'PT. General Food Industries Bandung'],
            ['id'=>'21', 'name'=>'PT. Indofood'],
            ['id'=>'22', 'name'=>'PT. Yakult Indonesia Persada'],
            ['id'=>'23', 'name'=>'PT. Monysaga Prima'],
            ['id'=>'24', 'name'=>'PT. Unilever Indonesia Tbk'],
            ['id'=>'25', 'name'=>'PT. SMART TBK'],
            ['id'=>'26', 'name'=>'PT. Salim Ivomas Pratama Tbk'],
            ['id'=>'27', 'name'=>'PT. Monysaga Prima'],
            ['id'=>'28', 'name'=>'PT. Monde Mahkota Biskuit'],
            ['id'=>'29', 'name'=>'PT. Perusahaan Industri Ceres'],
            ['id'=>'3', 'name'=>'PT. Nissin Biscuit Indonesia'],
            ['id'=>'30', 'name'=>'PT. Ultra Prima Abadi'],
            ['id'=>'31', 'name'=>'PT. Santos Jaya Abadi'],
            ['id'=>'32', 'name'=>'PT. So Good Food Manufacturing'],
            ['id'=>'33', 'name'=>'PT. Unilever Indonesia Tbk'],
            ['id'=>'34', 'name'=>'PT. Coca Cola Bottling Indonesia'],
            ['id'=>'35', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'36', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'37', 'name'=>'PT. Dellifood Sentosa Corpindo'],
            ['id'=>'38', 'name'=>'PT. General Food Industries Bandung'],
            ['id'=>'39', 'name'=>'PT. Santos Jaya Abadi'],
            ['id'=>'4', 'name'=>'PT. Unilever Indonesia Tbk'],
            ['id'=>'40', 'name'=>'PT. Marizarasa Sarimurni (Factory 2)'],
            ['id'=>'41', 'name'=>'PT. Unilever Indonesia Tbk'],
            ['id'=>'42', 'name'=>'PT. Nirwana Lestari'],
            ['id'=>'43', 'name'=>'PT. Keong Nusantara Abadi'],
            ['id'=>'44', 'name'=>'PT. Ikafood Putamas'],
            ['id'=>'45', 'name'=>'PT. Mayora Indah Tbk'],
            ['id'=>'46', 'name'=>'PT. Unilever Indonesia Tbk'],
            ['id'=>'47', 'name'=>'PT. Forisa Nusapersada'],
            ['id'=>'48', 'name'=>'PT. Frisian Flag Indonesia'],
            ['id'=>'49', 'name'=>'PT. Industri Jamu & Farmasi Sidomuncul'],
            ['id'=>'5', 'name'=>'PT. Arnott`s Indonesia'],
            ['id'=>'50', 'name'=>'PT. Indolakto'],
            ['id'=>'51', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'52', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'53', 'name'=>'PT. Torabika Eka Semesta'],
            ['id'=>'54', 'name'=>'PT. Torabika Eka Semesta'],
            ['id'=>'55', 'name'=>'PT. Riau Sakti United Plantation'],
            ['id'=>'56', 'name'=>'PT. ABC President Indonesia'],
            ['id'=>'57', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'58', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'59', 'name'=>'PT. Santos Jaya Abadi'],
            ['id'=>'60', 'name'=>'PT. Bina Karya Prima'],
            ['id'=>'61', 'name'=>'PT. Indolakto'],
            ['id'=>'62', 'name'=>'PT. Pulau Sambu'],
            ['id'=>'63', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'64', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'65', 'name'=>'PT. Ultrajaya Milk Industry & Trading Co.Tbk'],
            ['id'=>'66', 'name'=>'PT. Ultrajaya Milk Industry & Trading Co.Tbk'],
            ['id'=>'67', 'name'=>'PT. Nippon Indosari Corpindo, Tbk'],
            ['id'=>'68', 'name'=>'PT. Perusahaan Industri Ceres'],
            ['id'=>'69', 'name'=>'PT. Perusahaan Industri Ceres'],
            ['id'=>'70', 'name'=>'PT. Indofood CBP Sukses Makmur Tbk'],
            ['id'=>'71', 'name'=>'PT. Nutrifood Indonesia, Raya Ciawi '],
            ['id'=>'72', 'name'=>'PT. Industri Jamu & Farmasi Sidomuncul'],
            ['id'=>'73', 'name'=>'PT. Nestle Indonesia'],
            ['id'=>'74', 'name'=>'PT. Nestle Indonesia'],
            ['id'=>'75', 'name'=>'PT. Frisian Flag Indonesia'],
            ['id'=>'76', 'name'=>'PT. Makindo Perdana '],
            ['id'=>'77', 'name'=>'PT. Nutrifood Indonesia'],
            ['id'=>'78', 'name'=>'PT. Simba Indosnack Makmur'],
            ['id'=>'79', 'name'=>'PT. Torabika Eka Semesta'],
            ['id'=>'80', 'name'=>'PT. Lotte Indonesia'],
            ['id'=>'81', 'name'=>'PT. Arnott`s Indonesia'],
            ['id'=>'82', 'name'=>'PT. Ultra Prima Abadi'],
            ['id'=>'83', 'name'=>'PT. Mayora Indah Tbk'],
            ['id'=>'84', 'name'=>'PT. Arnott`s Indonesia'],
            ['id'=>'85', 'name'=>'PT. Nissin Biscuit Indonesia'],
            ['id'=>'86', 'name'=>'PT. Nirwana Lestari'],
            ['id'=>'87', 'name'=>'PT. Hale International'],
            ['id'=>'88', 'name'=>'PT. Kalbe'],
            ['id'=>'89', 'name'=>'PT. Hokkan Indonesia'],
            ['id'=>'90', 'name'=>'PT. Kaldu Sari Nabati Indonesia'],
            ['id'=>'91', 'name'=>'PT. Kaldu Sari Nabati Indonesia'],
            ['id'=>'92', 'name'=>'PT. Segarindo Primajaya'],
            ['id'=>'93', 'name'=>'PT. Matahari Putra'],
            ['id'=>'94', 'name'=>'PT. Asiacapital Utama Indonesia'],
            ['id'=>'95', 'name'=>'PT. Unimos'],
            ['id'=>'96', 'name'=>'PT. Jadi Abadi Corak Biscuit Factory Indonesia'],
            ['id'=>'97', 'name'=>'PT. Unimos'],
            ['id'=>'98', 'name'=>'PT. Unimos'],
            ['id'=>'99', 'name'=>'PT. Jeinz ABC Indonesia'],
            ['id'=>'109', 'name'=>'Pakuwon Enam Satu'],
            ['id'=>'110', 'name'=>'PT. Sari Incofood Corporation'],
        ];

        // masukkan data ke database
        DB::table('manufactures')->insert($man);
    }
}
