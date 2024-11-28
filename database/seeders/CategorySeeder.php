<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\categoria;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categoria::create(['categoria' => 'Fiction']);
        categoria::create(['categoria' => 'Science']);
    }
}
