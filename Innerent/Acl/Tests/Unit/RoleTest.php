<?php

namespace Innerent\Acl\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Innerent\Acl\Models\Role;
use Innerent\Acl\Repositories\RoleRepository;
use Innerent\Acl\Services\RoleService;
use Innerent\People\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    private $authUser;

    function setUp(): void
    {
        parent::setUp();

        $this->authUser = factory(User::class)->create();
    }

    public function testCreateRole()
    {
        $data = factory(Role::class)->make()->toArray();

        $this->actingAs($this->authUser, 'api')->json('post', config('foundation.api.prefix').'/roles', $data)
            ->assertStatus(201);
    }

    public function testListRoles()
    {
        $this->actingAs($this->authUser, 'api')->json('get', config('foundation.api.prefix').'/roles')
            ->assertStatus(200);
    }

    public function testShowRole()
    {
        $roleService = new RoleService(new RoleRepository(new Role()));
        $role = $roleService->make(factory(Role::class)->make()->toArray());

        $this->actingAs($this->authUser, 'api')->json('get', config('foundation.api.prefix').'/roles/' . $role->id)
            ->assertStatus(200);
    }

    public function testUpdateRole()
    {
        $roleService = new RoleService(new RoleRepository(new Role()));
        $role = $roleService->make(factory(Role::class)->make()->toArray());

        $newData = factory(Role::class)->make()->toArray();

        $roleUpdated = $roleService->make($newData)->toArray();
        $roleUpdated['id'] = $role->id;

        $this->actingAs($this->authUser, 'api')->json('put', config('foundation.api.prefix').'/roles/' . $role->id, $newData)
            ->assertJsonFragment($roleUpdated)
            ->assertStatus(200);
    }

    public function testDeleteRole()
    {
        $roleService = new RoleService(new RoleRepository(new Role()));
        $role = $roleService->make(factory(Role::class)->make()->toArray());

        $this->actingAs($this->authUser, 'api')->json('delete', config('foundation.api.prefix').'/roles/' . $role->id)->assertStatus(204);
    }
}
