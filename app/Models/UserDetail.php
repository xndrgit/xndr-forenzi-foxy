<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'id';

    public function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
