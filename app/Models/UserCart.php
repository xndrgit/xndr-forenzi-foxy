<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
