<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('admins')->insert(array(
            array('name'=>'admin','email' => 'admin@gmail.com','password' => bcrypt('admin@123')),
        ));

    }
}
