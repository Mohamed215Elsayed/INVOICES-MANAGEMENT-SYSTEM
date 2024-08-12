<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; //
use Spatie\Permission\Models\Role; //
use Spatie\Permission\Models\Permission; //

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        //
        // $user = User::create([
        //     'name' => 'Mohamed Elsayed', 
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);
        // $role = Role::create(['name' => 'Admin']);
        // $permissions = Permission::pluck('id','id')->all();
        // $role->syncPermissions($permissions);
        // $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'Mohamed Elsayed',
            'email' => 'moeid344@gmail.com',
            'password' => bcrypt('123456'),
            'roles_name' => ["owner"],//not forget [] for first one addition
            'Status' => 'مفعل',
        ]);
        $role = Role::create(['name' => 'owner']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
