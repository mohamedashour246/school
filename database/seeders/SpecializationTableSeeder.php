<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();

        $specializations = [

            ['en' => 'Arabic' ,   'ar' => 'عربى'],
            ['en' => 'Sciences' , 'ar' => 'علوم'],
            ['en' => 'Computer' , 'ar' => 'حاسب آلى'],
            ['en' => 'English' ,  'ar' => 'انجليزى'],
        ];

        foreach($specializations as $sp)
        {
            Specialization::create(['name' => $sp]);
        }
    }
}
