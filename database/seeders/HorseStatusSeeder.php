<?php

namespace Database\Seeders;

use App\Models\HorseStatus;
use Illuminate\Database\Seeder;

class HorseStatusSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Racing', 'Retired', 'Injured', 'Resting'];
        foreach ($names as $name) {
            HorseStatus::firstOrCreate(['name' => $name]);
        }
    }
}
