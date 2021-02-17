<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $User = array(
            array(
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Admin Satu',
                'email'=>'dery@test.com',
                'password'=>Hash::make('adminadmin'),
                //admin

               
            ),
            array(
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'User Satu',
                'email'=>'user@test.com',
                'password'=>Hash::make('useruser'),    
                //verif user           
            ),
            array(
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Guest Satu',
                'email'=>'guest@test.com',
                'password'=>Hash::make('guestguest'),               
            ),
        );
        
        DB::table('users')->insert($User);
    }
}
