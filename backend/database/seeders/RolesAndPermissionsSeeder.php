<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // users permissions
            Permission::create(['name' => 'create users']);
            Permission::create(['name' => 'read users']);
            Permission::create(['name' => 'update users']);
            Permission::create(['name' => 'delete users']);

            // incidents permissions
            Permission::create(['name' => 'create incidents']);
            Permission::create(['name' => 'read incidents']);
            Permission::create(['name' => 'update incidents']);
            Permission::create(['name' => 'delete incidents']);

            // countries permissions
            Permission::create(['name' => 'create countries']);
            Permission::create(['name' => 'read countries']);
            Permission::create(['name' => 'update countries']);
            Permission::create(['name' => 'delete countries']);

            // incident types permissions
            Permission::create(['name' => 'create incident types']);
            Permission::create(['name' => 'read incident types']);
            Permission::create(['name' => 'update incident types']);
            Permission::create(['name' => 'delete incident types']);

            // incident statuses permissions
            Permission::create(['name' => 'create incident statuses']);
            Permission::create(['name' => 'read incident statuses']);
            Permission::create(['name' => 'update incident statuses']);
            Permission::create(['name' => 'delete incident statuses']);


            // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            //observer role
            Role::create(['name' => 'observer'])
                ->givePermissionTo([
                    'create incidents',
                    'read incidents',
                    'update incidents',
                    'delete incidents'
                ]);

            //admin role
            Role::create(['name' => 'admin'])->givePermissionTo([
                'create incidents',
                'read incidents',
                'update incidents',
                'delete incidents',
                'create users',
                'read users',
                'update users',
                'delete users',
                'create countries',
                'read countries',
                'update countries',
                'delete countries',
                'create incident types',
                'read incident types',
                'update incident types',
                'delete incident types',
                'create incident statuses',
                'read incident statuses',
                'update incident statuses',
                'delete incident statuses',
            ]);

            //root role
            Role::create(['name' => 'root'])->givePermissionTo(Permission::all());
        }
    }
}
