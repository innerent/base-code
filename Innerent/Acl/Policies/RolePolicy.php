<?php

namespace Innerent\Acl\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Innerent\Acl\Models\Role;
use Innerent\People\Models\User;

class RolePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function view(User $user, Role $role)
    {
        return true;
    }

    public function update(User $user, Role $role)
    {
        return true;
    }

    public function delete(User $user, Role $role)
    {
        return true;
    }
}
