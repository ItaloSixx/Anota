<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create multi users
        DB::table('users')->insert([
        [
            'username' => 'italojefer@gmail.com',
            'password' => bcrypt('italo123'),
            'created_at' => date('Y-m-d ')
        ],
        [
            'username' => 'italojefer1@gmail.com',
            'password' => bcrypt('italo123'),
            'created_at' => date('Y-m-d ')
        ],
        [
            'username' => 'italojefer2@gmail.com',
            'password' => bcrypt('italo123'),
            'created_at' => date('Y-m-d ')
        ],
    ]);
    }
}
