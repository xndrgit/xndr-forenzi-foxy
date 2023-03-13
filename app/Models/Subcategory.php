<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subcategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_subcategory', 'subcategory_id', 'product_id');
    }

    public function categories()
    : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_subcategories', 'subcategory_id', 'category_id');
    }
}
