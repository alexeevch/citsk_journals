<?php

namespace Database\Seeders;

use App\Constants;
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
            Permission::create(['name' => 'user.create', "description" => "Добавление пользователей"]);
            Permission::create(['name' => 'user.read', "description" => "Просмотр пользователей"]);
            Permission::create(['name' => 'user.update', "description" => "Редактирование пользователей"]);
            Permission::create(['name' => 'user.delete', "description" => "Удаление пользователей"]);

            // incidents permissions
            Permission::create(['name' => 'incident.create', "description" => "Добавление инцидентов"]);
            Permission::create(['name' => 'incident.read', "description" => "Просмотр инцидентов"]);
            Permission::create(['name' => 'incident.update', "description" => "Редактирование инцидентов"]);
            Permission::create(['name' => 'incident.delete', "description" => "Удаление инцидентов"]);

            // countries permissions
            Permission::create(['name' => 'country.create', "description" => "Добавление стран"]);
            Permission::create(['name' => 'country.read', "description" => "Просмотр стран"]);
            Permission::create(['name' => 'country.update', "description" => "Редактирование стран"]);
            Permission::create(['name' => 'country.delete', "description" => "Удаление стран"]);

            // incident types permissions
            Permission::create(['name' => 'incident_type.create', "description" => "Добавление инцидентов"]);
            Permission::create(['name' => 'incident_type.read', "description" => "Просмотр инцидентов"]);
            Permission::create(['name' => 'incident_type.update', "description" => "Обновление инцидентов"]);
            Permission::create(['name' => 'incident_type.delete', "description" => "Удаление инцидентов"]);

            // incident statuses permissions
            Permission::create(['name' => 'incident_status.create', "description" => "Добавление статусов инцидента"]);
            Permission::create(['name' => 'incident_status.read', "description" => "Просмотр статусов инцидента"]);
            Permission::create(['name' => 'incident_status.update', "description" => "Обновление статусов инцидента"]);
            Permission::create(['name' => 'incident_status.delete', "description" => "Удаление статусов инцидента"]);

            // attackers permissions
            Permission::create(['name' => 'attacker.create', "description" => "Добавление злоумышленников"]);
            Permission::create(['name' => 'attacker.read', "description" => "Просмотр злоумышленников"]);
            Permission::create(['name' => 'attacker.update', "description" => "Обновление злоумышленников"]);
            Permission::create(['name' => 'attacker.delete', "description" => "Удаление злоумышленников"]);

            // roles permissions
            Permission::create(['name' => 'role.create', "description" => "Добавление ролей"]);
            Permission::create(['name' => 'role.read', "description" => "Просмотр ролей"]);
            Permission::create(['name' => 'role.update', "description" => "Обновление ролей"]);
            Permission::create(['name' => 'role.delete', "description" => "Удаление ролей"]);

            // permissions
            Permission::create(['name' => 'permission.create', "description" => "Добавление прав"]);
            Permission::create(['name' => 'permission.read', "description" => "Просмотр прав"]);
            Permission::create(['name' => 'permission.update', "description" => "Обновление прав"]);
            Permission::create(['name' => 'permission.delete', "description" => "Удаление прав"]);


            // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            //root role
            Role::create([
                'name' => Constants::ROOT_ROLE, "description" => "Повелитель системой"
            ])->givePermissionTo(Permission::all());

            //admin role
            Role::create(['name' => Constants::ADMIN_ROLE, "description" => "Администратор"])->givePermissionTo([
                'incident.create',
                'incident.read',
                'incident.update',
                'incident.delete',
                'user.create',
                'user.read',
                'user.update',
                'user.delete',
                'country.create',
                'country.read',
                'country.update',
                'country.delete',
                'incident_type.create',
                'incident_type.read',
                'incident_type.update',
                'incident_type.delete',
                'incident_status.create',
                'incident_status.read',
                'incident_status.update',
                'incident_status.delete',
                'attacker.create',
                'attacker.read',
                'attacker.update',
                'attacker.delete',
            ]);

            //observer role
            Role::create(['name' => Constants::OBSERVER_ROLE, "description" => "Оперативный дежурный"])
                ->givePermissionTo([
                    'incident.create',
                    'incident.read',
                    'incident.update',
                    'incident.delete',
                    'incident_type.create',
                    'incident_type.read',
                    'incident_type.update',
                    'incident_type.delete',
                ]);
        }
    }
}
