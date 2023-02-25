<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    public function orders()
    : BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')->withPivot('quantity');
    }

    public function category()
    : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    : BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function users()
    : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_carts', 'product_id', 'user_id')->withPivot('quantity');
    }
}
