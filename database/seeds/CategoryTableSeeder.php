<?php

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = ['1 ONDA', '2 ONDE', 'ECOLOGICHE', 'ECOMMERCE', 'NATALIZIE', 'CONFEZIONI', 'IMBALLAGGIO'];
        $colors = ['orange-box', 'yellow-box'];
        $image = ['https://www.freepnglogos.com/uploads/box-png/box-png-transparent-google-objects-pinterest-9.png'];
        $logo = ['https://www.freepnglogos.com/uploads/logo-website-png/logo-website-file-globe-icon-svg-wikimedia-commons-21.png'];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->description = $faker->sentence(50);
            $newCategory->mini_description = $faker->sentence(10);
            $newCategory->color = $faker->randomElement($colors);
            $newCategory->img = $faker->randomElement($image);
            $newCategory->img2 = $faker->randomElement($logo);
            $newCategory->save();
        }
    }
}
