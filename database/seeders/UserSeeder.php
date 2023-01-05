<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '@dmin',
            'email' =>'ad@may.com',
            'password' => Hash::make('R3n0vaDorA/'),
          
        ]); 

        DB::table('users')->insert([
            'name' => '@dmin',
            'email' =>'misifus@may.com.com',
            'password' => Hash::make('zapatero'),
          
        ]); 

        DB::table('users')->insert([
            'name' => '@dmin',
            'email' =>'renovadora@may.com',
            'password' => Hash::make('muñeco'),
          
        ]); 

          DB::table('users')->insert([
            'name' => '@dmin',
            'email' =>'renovadora3@may.com',
            'password' => Hash::make('j0s3jos3ñ'),
          
        ]); 
    }
}
