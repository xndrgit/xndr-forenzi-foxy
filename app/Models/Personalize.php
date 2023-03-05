<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personalize extends Model
{
    protected $table = 'personalizes';

    protected $fillable = [
        'user_id', 'receipt_email', 'sender_email', 'first_name', 'last_name', 'business_name', 'address',
        'phone', 'length', 'width', 'height', 'quantity', 'color', 'cardboard_type', 'press_type'
    ];
}
