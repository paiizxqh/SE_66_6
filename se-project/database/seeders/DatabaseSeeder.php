<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',

        'role-list',
        'role-create',
        'role-edit',
        'role-delete',

        'project-list',
        'project-create',
        'project-edit',
        'project-delete',

        'product-list',
        'product-create',
        'product-edit',
        'product-delete',

        'customer-list',
        'customer-create',
        'customer-edit',
        'customer-delete',
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([ProjectSeeder::class]);
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //Create admin User and assign the role to him.
        $user = User::create([
            'employee_id' => 'EMP001',
            'name' => 'AdminTest',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
