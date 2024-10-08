<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
    [
        'name'=> 'Mas Admin',
        'email'=> 'admin@gmail.com',
        'role' => 'admin',
        'password' => bcrypt('123456')
    ],
    [
        'name'=> 'Mas TU',
        'email'=> 'tu@gmail.com',
        'role' => 'tu',
        'password' => bcrypt('123456')
    ],
    [
        'name'=> 'Mas Peserta',
        'email'=> 'peserta@gmail.com',
        'role' => 'peserta',
        'password' => bcrypt('123456')
    ],
    [
        'name'=> 'Mas Pembimbing',
        'email'=> 'pembimbing@gmail.com',
        'role' => 'pembimbing',
        'password' => bcrypt('123456')
    ],
    [
        'name'=> 'Mas kabin',
        'email'=> 'kabin@gmail.com',
        'role' => 'kabin',
        'password' => bcrypt('123456')
    ],
    ]);

    }
}