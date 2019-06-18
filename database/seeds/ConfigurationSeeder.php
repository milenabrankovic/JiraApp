<?php

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            [
                'name' => 'Energoprojekt Entel'
            ]
         ]);
         DB::table('sprint_info')->insert([
            [
                'length' => 14, //two weeks is default duration
                'points' => 55
            ]
         ]);
    }
}
