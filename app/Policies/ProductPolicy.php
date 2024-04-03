<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

public function viewAny(User $user)
{
    // Users with role 1 (admin) can view all records
    // Users with role 2 can view only records they uploaded
    // return $user->role == 1 || ($user->role == 2 && $user->Products()->exists());
     return true;
}

public function view(User $user, Product $product)
{
    // Users with role 1 (admin) can view all records
    // Users with role 2 can view only their own records
    // return $user->role == 1 || $user->id === $Product->users()->pluck('users.id')->first();
    return true;
}


    public function create(User $user)
    {
        return true; // Both roles can create records
    }

    public function update(User $user, Product $product)
    {
        // Users with role 1 (admin) can update any record
        // Other users can only update their own records
        return $user->role == 1 || $user->id === $product->users()->pluck('users.id')->first();
    }

    public function delete(User $user, Product $product)
    {
        // Users with role 1 (admin) can delete any record
        // Other users can only delete their own records
        return $user->role == 1 || $user->id === $product->users()->pluck('users.id')->first();
    }

    public function deleteBulk(User $user, Product $product)
    {
        // Both roles can delete their own records
        // Additionally, role 1 can delete any record
        return $user->role == 1 || $user->id == $product->user_id;
    }
}
