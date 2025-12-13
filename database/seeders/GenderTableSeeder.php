<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->delete();

        $genders = [

            ['en' => 'Male' , 'ar' => 'ذكر'],
            ['en' => 'Female' , 'ar' => 'أنثى'],

        ];

        foreach($genders as $g)
        {
            Gender::create(['name' => $g]);
        }
    }
}
