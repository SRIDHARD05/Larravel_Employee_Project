<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    public function run()
    {

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);

        $editArticles = Permission::firstOrCreate(['name' => 'edit-articles']);
        $deleteArticles = Permission::firstOrCreate(['name' => 'delete-articles']);

        $admin->permissions()->sync([$editArticles->id, $deleteArticles->id]);
        $editor->permissions()->sync([$editArticles->id]);

        $user = User::find(1);
        if ($user) {
            $user->roles()->attach([$admin->id, $editor->id]);
        }
    }
}
