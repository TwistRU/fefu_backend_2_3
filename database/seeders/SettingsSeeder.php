<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Settings::query()->truncate();
        DB::table('settings')->insert([
            'frequency' => 5,
            'max_attempts' => 5,
        ]);
    }
}
