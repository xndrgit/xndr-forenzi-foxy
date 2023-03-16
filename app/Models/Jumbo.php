<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jumbo extends Model
{
    protected $fillable = ['title', 'description', 'src', 'order_number'];
}
