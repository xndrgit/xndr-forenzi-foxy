<?php

namespace App;

use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\userDetail;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetail()
    : HasOne
    {
        return $this->hasOne(userDetail::class);
    }

    public function orders()
    : HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function userroles()
    : HasMany
    {
        return $this->hasMany(UserRole::class);
    }

    public function roles()
    : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function products()
    : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'user_carts', 'user_id', 'product_id')->withPivot('quantity');
    }
}
