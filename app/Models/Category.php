<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'img', 'img2', 'color', 'description', 'mini_description'];
    public function products()
    : HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subcategories()
    : BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'category_subcategories', 'category_id', 'subcategory_id');
    }
}
