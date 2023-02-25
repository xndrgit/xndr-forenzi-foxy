<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    protected $primaryKey = 'user_id';
    protected $table      = 'role_user';
    protected $fillable   = ['user_id'];

    public function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
