<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{
    public function model()
    {
        return app(Product::class);
    }
}
