<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cabinLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /* The code snippet you provided is inserting data into a table named 'cabin_levels' in the
        database. It is inserting two rows of data into this table. */
        DB::table('cabin_level')->insert([
            'name' => 'vip',
            'description' => 'cabañas para genete importante',
        ]);
        DB::table('cabin_level')->insert([
            'name' => 'basica',
            'description' => 'cabañas para genete normal',
        ]);
    }
}
