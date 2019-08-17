<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
                'first_name' => 'Milena',
                'last_name' => 'Brankovic',
                'username' => 'mbrankovic',
                'email' => 'mbrankovic@ep-entel.com',
                'password' => bcrypt('milena123'),
                'role_id' => 2,
                'parent_id' => null
            ],
            [
                'first_name' => 'Petar',
                'last_name' => 'Petrovic',
                'username' => 'ppetrovic',
                'email' => 'ppetrovic@ep-entel.com',
                'password' => bcrypt('petar123'),
                'role_id' => 2,
                'parent_id' => 1
            ],
            [
                'first_name' => 'Jovan',
                'last_name' => 'Djuric',
                'username' => 'jdjuric',
                'email' => 'jdjuric@ep-entel.com',
                'password' => bcrypt('jdjuric123'),
                'role_id' => 2,
                'parent_id' => 2
            ],
            [
                'first_name' => 'Milica',
                'last_name' => 'Jovic',
                'username' => 'mjovic',
                'email' => 'mjovic@ep-entel.com',
                'password' => bcrypt('mjovic123'),
                'role_id' => 2,
                'parent_id' => 2
            ]
         ]);
    }
}
