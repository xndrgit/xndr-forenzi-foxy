<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $categories = Category::all();
        $subcategories = Subcategory::all();

        $colors = ['bianca', 'avana'];
        $prints = ['personalizzata', 'neutra'];

        $purchasable_in_multi_of = [1, 2, 3, 4, 5, 10, 20, 30, 50, 100, 200];

        for ($i = 0; $i < 36; $i++) {
            $newProduct = new Product();
            $newProduct->code = $faker->unique()->randomNumber(8);
            $newProduct->name = $faker->name;
            $newProduct->length = $faker->randomFloat(2, 10, 1000);
            $newProduct->height = $faker->randomFloat(2, 10, 1000);
            $newProduct->width = $faker->randomFloat(2, 10, 1000);
            $newProduct->color = $faker->randomElement($colors);
            $newProduct->print = $faker->randomElement($prints);
            $newProduct->description = $faker->paragraph;

            $newProduct->quantity = $faker->randomNumber(3);
            $newProduct->img = $faker->imageUrl(640, 480);
            $newProduct->created_at = Carbon::now();
            $newProduct->updated_at = Carbon::now();
            $newProduct->mini_description = $faker->sentence;
            $newProduct->weight = $faker->randomFloat(2, 10, 1000);

            $newProduct->price = $faker->randomFloat(2, 9.99, 12.99);
            $newProduct->first_price = $faker->randomFloat(2, 8.99, 9.99);
            $newProduct->second_price = $faker->randomFloat(2, 7.99, 8.99);
            $newProduct->third_price = $faker->randomFloat(2, 3.99, 7.99);
            $newProduct->fourth_price = $faker->randomFloat(2, 1.99, 6.99);
            $newProduct->price_saled = $faker->randomElement([null, $faker->randomFloat(2, $newProduct->price - 0.99, 5.99)]);

            $newProduct->purchasable_in_multi_of = $faker->randomElement($purchasable_in_multi_of);
            $newProduct->category_id = $faker->randomElement($categories)->id;
            $newProduct->save();
        }
    }
}
