<?php

use App\Models\Subcategory;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $subcategories = [
            'subcategory1', 'subcategory2', 'subcategory3', 'subcategory4', 'subcategory5', 'subcategory6', 'subcategory7', 'subcategory8', 'subcategory9', 'subcategory10',
            'subcategory11', 'subcategory12'
        ];

        foreach ($subcategories as $subcategory) {
            $newSubcategory = new Subcategory();
            $newSubcategory->name = $subcategory;
            $newSubcategory->description = $faker->paragraph;
            $newSubcategory->save();
        }
    }
}
