<?php

namespace Database\Seeders;

use App\Models\Film;
use BladeUI\Icons\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::factory()->count(5)->create();
    }
}
