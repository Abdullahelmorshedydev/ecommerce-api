<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->where('morphable_type', '=', 'App\Models\Product')->delete();
        foreach (Product::get() as $product) {
            $product->images()->create([
                'image' => 'products/OfmJ97Ep84kVhnJQloLsL3fmwMEF3nf4sIwtAQUI.jpg',
            ]);
            $product->images()->create([
                'image' => 'products/BlkcR7Xh3Bu4S1yQ7PaCyb590VawiUby7W15sukt.png',
            ]);
        }
    }
}
