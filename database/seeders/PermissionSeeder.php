<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[
            \Spatie\Permission\PermissionRegistrar::class
        ]->forgetCachedPermissions();

        // create permissions
        $arrayOfPermissionNames = [
            // Posts
            "create user",
            "edit user",
            "update user",
            "delete user",
            // Users
            "access users",
            // ....
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function (
            $permission
        ) {
            return ["name" => $permission, "guard_name" => "web"];
        });

        Permission::insert($permissions->toArray());

        // create role & give it permissions
        Role::create(["name" => "admin"])->givePermissionTo(Permission::all());
        Role::create(["name" => "user"])->givePermissionTo(['access users']);

        // Assign roles to users (in this case for user id -> 1 & 2)
        // User::find(1)->assignRole('admin');
        // User::find(2)->assignRole('user');

        $user = User::create([
            'fullname'=> 'Elemson Ifeanyi',
            'username'=> 'ielemson',
            'email' => 'ielemson@gmail.com',
            'password' => Hash::make('secret123'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
    }
}
