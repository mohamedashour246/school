<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'session'  , 'value' => '2021-2022'],
            ['key' => 'school_title'  , 'value' => 'MoraSchool'],
            ['key' => 'school_name'  , 'value' => 'El-mahalla'],
            ['key' => 'first_term'  , 'value' => '05-01-2021'],
            ['key' => 'second_term'  , 'value' => '07-02-2022'],
            ['key' => 'phone'  , 'value' => '01002258304'],
            ['key' => 'address'  , 'value' => 'Cairo'],
            ['key' => 'school_email'  , 'value' => 'Mora@gmail.com'],
            ['key' => 'logo'  , 'value' => 'first.jpg'],
        ];

        DB::table('settings')->insert($data);
    }
}
