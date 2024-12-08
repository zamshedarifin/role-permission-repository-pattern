<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    public function view(User $user, Post $post)
    {
        return $user->hasPermission('view-post');
    }

    public function create(User $user)
    {
        return $user->hasPermission('create-post');
    }

    public function update(User $user, Post $post)
    {
        return $user->hasPermission('update-post');
    }

    public function delete(User $user, Post $post)
    {
        return $user->hasPermission('delete-post');
    }
}
