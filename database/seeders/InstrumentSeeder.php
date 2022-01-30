<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstrumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instruments')->insert([
            'name' => 'ピアノ'
        ]);
        
        DB::table('instruments')->insert([
            'name' => 'ギター'
        ]);
        
        DB::table('instruments')->insert([
            'name' => 'バイオリン'
        ]);
        
        DB::table('instruments')->insert([
            'name' => 'チェロ'
        ]);
        
        DB::table('instruments')->insert([
            'name' => 'フルート'
        ]);
        
        DB::table('instruments')->insert([
            'name' => 'トランペット'
        ]);
    }
}