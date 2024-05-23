<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->where('morphable_type', '=', 'App\Models\Category')->delete();
        foreach (Category::get() as $category) {
            $category->image()->create([
                'image' => 'categries/cBAExxHFE2ndJgpaHHMzwjYSHde7023LkNzWFXoj.jpg',
            ]);
        }
    }
}
