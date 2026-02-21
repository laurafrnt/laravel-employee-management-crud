<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Création rôle Client et Admin
        $roleClient = Role::create(['name' => 'client']);
        $roleAdmin = Role::create(['name' => 'admin']);

        // Création permission edit.user et client.user
        $permissionAdmin = Permission::create(['name' => 'edit.user']);
        $permissionClient = Permission::create(['name' => 'client.user']);

        // On fait un lien entre Admin et edit.user
        $roleAdmin->syncPermissions($permissionAdmin);
        $permissionAdmin->syncRoles($roleAdmin);

        // On fait un lien entre Client et client.user
        $roleClient->syncPermissions($permissionClient);
        $permissionClient->syncRoles($roleClient);

        // Création d'un Admin
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);
        $adminUser->givePermissionTo('edit.user');
        $adminUser->assignRole('admin');

        // Création d'un Client (connu)
        $clientUser = User::factory()->create([
            'name' => 'Utilisateur',
            'email' => 'utilisateur@gmail.com',
        ]);
        $clientUser->givePermissionTo('client.user');
        $clientUser->assignRole('client');

        // Création de plusieurs Users clients
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->givePermissionTo('client.user');
            $user->assignRole('client');
        }

    }
}
