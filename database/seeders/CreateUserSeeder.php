<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserSeeder extends Seeder
{

    public function run()
    {

             $user = User::create([
            'name' => 'Mona',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'roles_name' => ["owner"],
            'status' => 0,
            ]);

            $role = Role::create(['name' => 'owner']);

            $permissions = Permission::pluck('id','id')->all();

            $role->syncPermissions($permissions);

            $user->assignRole([$role->id]);


    }

}
