<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call('RoleSeeder');
         $this->call('UserSeeder');
         $this->call('FoodProductSeeder');
         $this->call('IngredientSeeder');
         $this->call('HalalSourcesSeeder');
         $this->call('CertificateSeeder');
         $this->call('ManufactureSeeder');
         $this->call('ForeignSeeder');

        Model::reguard();
    }
}
