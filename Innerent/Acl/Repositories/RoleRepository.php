<?php

namespace Innerent\Acl\Repositories;

use Innerent\Acl\Contracts\Role as RepositoryInterface;
use Innerent\Acl\Models\Role;
use Innerent\Foundation\Repositories\Repository;

class RoleRepository extends Repository implements RepositoryInterface
{
    function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
