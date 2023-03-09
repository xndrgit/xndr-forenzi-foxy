<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    : HasMany
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function categories()
    : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_subcategories', 'subcategory_id', 'category_id');
    }
}
