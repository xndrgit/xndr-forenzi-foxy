<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRepository extends Repository
{
    public function model()
    {
        return app(User::class);
    }

    /**
     * Get user's added cart items
     *
     * @param User $user
     *
     * @return BelongsToMany
     */
    public function getCartItems(User $user)
    : BelongsToMany
    {
        return $user->products()->with(['products.category', 'products.subcategory']);
    }
}
