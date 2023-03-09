<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'surname', 'business_name', 'notes', 'address', 'phone', 'city', 'cap', 'province', 'state', 'pec', 'code_sdi', 'admin'
    ];

    public function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
