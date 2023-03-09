<?php

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class ProductSubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $randomSubcategories = Subcategory::inRandomOrder()->limit(2)->get();
            foreach ($randomSubcategories as $subcategory) {
                $product->subcategories()->attach($subcategory->id);
            }
        }
    }
}
