<?php

namespace Innerent\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $tableNames = config('permission.table_names');

        $roles = [
            [
                'name' => 'innerent',
                'description' => 'Innerent',
                'type' => 'permissive',
                'guard_name' => 'web'
            ],
            [
                'name' => 'owner_free',
                'description' => 'Proprietário [Plano Free]',
                'type' => 'permissive',
                'guard_name' => 'web'
            ],
            [
                'name' => 'owner_standard',
                'description' => 'Proprietário [Plano Standard]',
                'type' => 'permissive',
                'guard_name' => 'web'
            ],
            [
                'name' => 'owner_business',
                'description' => 'Proprietário [Plano Business]',
                'type' => 'permissive',
                'guard_name' => 'web'
            ],
            [
                'name' => 'owner_premium',
                'description' => 'Proprietário [Plano Premium]',
                'type' => 'permissive',
                'guard_name' => 'web'
            ],
            [
                'name' => 'renter',
                'description' => 'Inquilino',
                'type' => 'permissive',
                'guard_name' => 'web',
            ],
        ];

        Artisan::call('permission:migrate');

        DB::table($tableNames['roles'])->insert($roles);

        Role::whereIn('name', ['owner_free', 'owner_standard', 'owner_business', 'owner_premium'])->get()->each(function ($role, $key) {
            $role->givePermissionTo(['property_create', 'property_update', 'property_read', 'property_destroy']);
        });
    }
}
