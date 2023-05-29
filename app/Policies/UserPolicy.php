<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $user, User $model)
    {
        return $model->id === $user->id;
    }
}
