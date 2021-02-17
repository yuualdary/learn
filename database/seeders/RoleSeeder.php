<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = \App\Models\roleuser::get();

        $test = array(
            array(
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'rolename' => 'ADMIN',
               
            ),
            array(
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'rolename' => 'REGISUSER',
               
            ),
        );
        
        DB::table('roleusers')->insert($test);
      

        // DB::table('roleusers')->insert([
        //     'rolename' => 'REGISUSER'
        // ]);

    }
}
