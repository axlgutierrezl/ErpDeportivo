<?php

namespace Database\Seeders\LandLord;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@gmail.com";
        $user->password = \bcrypt("axel123");
        $user->save();
    }
}
