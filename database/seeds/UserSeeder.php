<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder{

    public function run(){
        DB::table('users')->delete();

        $adminRole = Role::whereName('administrator')->first();
        $userRole = Role::whereName('user')->first();

        $user = User::create(array(
            'first_name'    => 'Admin',
            'last_name'     => 'Istrator',
            'email'         => 'admin@halal.addi.is.its.ac.id',
            'password'      => Hash::make('p4s5w0rD')
        ));
        $user->assignRole($adminRole);

        $user = User::create(array(
            'first_name'    => 'User',
            'last_name'     => 'User',
            'email'         => 'user@halal.addi.is.its.ac.id',
            'password'      => Hash::make('userpassword')
        ));
        $user->assignRole($userRole);
    }
}