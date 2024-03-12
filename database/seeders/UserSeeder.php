<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@test',
            'sim' => "1231313131233131",
            'alamat' => 'jl. test ',
            'mobile_phone' => '93982482492',
            'password' => bcrypt('SiDiyaz')
        ]);

        $admin->assignRole('admin');


        $user = User::create([
            'name' => 'Anggota',
            'email' => 'user@test',
            'alamat' => 'jl. test123',
            'sim' => "09345839859348534",
            'mobile_phone' => '123131312',
            'password' => bcrypt('Diyaz')
        ]);

        $user->assignRole('anggota');



    }
}
