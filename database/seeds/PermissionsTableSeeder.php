<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //Create Permissions
        Permission::create(['name' => 'create task', 'guard_name' => 'web']);
        Permission::create(['name' => 'read tasks', 'guard_name' => 'web']);
        Permission::create(['name' => 'update task', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete task', 'guard_name' => 'web']);

        //Super-Admin
        $SuperAdmin = Role::create([
            'name'       => 'Super-Admin',
            'guard_name' => 'web'
        ]);

        //Admin
        $admin = Role::create([
            'name'       => 'Admin',
            'guard_name' => 'web'
        ]);
        
        $admin->givePermissionTo([
            'create task',
            'read tasks',
            'update task',
            'delete task'
        ]);

        //Guest
        $guest = Role::create([
            'name'       => 'Guest',
            'guard_name' => 'web'
        ]);
        $admin->givePermissionTo([            
            'read tasks'
        ]);

        $user = User::find(1);
        $user->assignRole('Super-Admin');

        $user2 = User::find(2);
        $user2->assignRole('Admin');

        $user3 = User::find(3);
        $user3->assignRole('Guest');
    }
}
