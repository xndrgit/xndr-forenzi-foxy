<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySubcategory extends Model
{
    protected $table = 'category_subcategories';

    protected $fillable = ['category_id', 'subcategory_id'];

    public $timestamps = false;
}
