<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RoleService
{

    public function assignRolesToUser(int $userId): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);

        $editArticles = Permission::firstOrCreate(['name' => 'edit-articles']);
        $deleteArticles = Permission::firstOrCreate(['name' => 'delete-articles']);

        $admin->permissions()->sync([$editArticles->id, $deleteArticles->id]);
        $editor->permissions()->sync([$editArticles->id]);

        $user = User::find($userId);
        if ($user) {
            $user->roles()->attach([$admin->id, $editor->id]);
        }
    }

    public function addPermissionsToRole(string $roleName, array $permissionNames): void
    {
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $permissions = Permission::whereIn('name', $permissionNames)->get();
            $role->permissions()->sync($permissions->pluck('id')->toArray());
        }
    }

    public function removePermissionsFromRole(string $roleName, array $permissionNames): void
    {
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $permissions = Permission::whereIn('name', $permissionNames)->get();
            $role->permissions()->detach($permissions->pluck('id')->toArray());
        }
    }

    public function viewRole(string $roleName): ?Role
    {
        return Role::where('name', $roleName)->first();
    }

    public function viewUser(int $userId): ?User
    {
        return User::find($userId);
    }

    public function viewPermissionsForRole(string $roleName)
    {
        $role = Role::where('name', $roleName)->first();

        return $role ? $role->permissions : collect();
    }

    public function updateRoleName(string $oldRoleName, string $newRoleName): bool
    {
        $role = Role::where('name', $oldRoleName)->first();

        if ($role) {
            $role->name = $newRoleName;
            return $role->save();
        }

        return false;
    }

    public function updatePermissionName(string $oldPermissionName, string $newPermissionName): bool
    {
        $permission = Permission::where('name', $oldPermissionName)->first();

        if ($permission) {
            $permission->name = $newPermissionName;
            return $permission->save();
        }

        return false;
    }

    public function deleteRole(string $roleName): bool
    {
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            return $role->delete();
        }

        return false;
    }

    public function deletePermission(string $permissionName): bool
    {
        $permission = Permission::where('name', $permissionName)->first();

        if ($permission) {
            return $permission->delete();
        }

        return false;
    }

    public function removeRoleFromUserById(int $userId, string $roleName)
    {
        $user = User::find($userId);
        $role = Role::where('name', $roleName)->first();

        if ($user && $role) {
            $user->roles()->detach($role->id);
        }
    }


    public function deleteUserRoleAssociation(int $userId, string $roleName): void
    {
        $user = User::find($userId);
        $role = Role::where('name', $roleName)->first();

        if ($user && $role) {
            $user->roles()->detach($role->id);
        }
    }

    public function createRole(string $roleName): Role
    {
        return Role::create(['name' => $roleName]);
    }

    public function createPermission(string $permissionName): Permission
    {
        return Permission::create(['name' => $permissionName]);
    }

    public function assignRoleToUser(int $userId, string $roleName): void
    {
        $user = User::find($userId);
        $role = Role::firstOrCreate(['name' => $roleName]);

        if ($user) {
            $user->roles()->attach($role->id);
        }
    }

    public function assignPermissionToRole(string $roleName, string $permissionName): void
    {
        $role = Role::where('name', $roleName)->first();
        $permission = Permission::firstOrCreate(['name' => $permissionName]);

        if ($role) {
            $role->permissions()->attach($permission->id);
        }
    }

    public function removePermissionFromRole(string $roleName, string $permissionName): void
    {
        $role = Role::where('name', $roleName)->first();
        $permission = Permission::where('name', $permissionName)->first();

        if ($role && $permission) {
            $role->permissions()->detach($permission->id);
        }
    }
}


/* 
use App\Services\RoleService;

// Create an instance of the RoleService
$roleService = new RoleService();

// Create a new role
$roleService->createRole('manager');

// Create a new permission
$roleService->createPermission('approve-articles');

// Assign a role to a user
$roleService->assignRoleToUser(1, 'manager');

// Assign a permission to a role
$roleService->assignPermissionToRole('manager', 'approve-articles');

// Remove a role from a user
$roleService->removeRoleFromUser(1, 'manager');

// Remove a permission from a role
$roleService->removePermissionFromRole('manager', 'approve-articles');

// Delete a role
$roleService->deleteRole('manager');

// Delete a permission
$roleService->deletePermission('approve-articles');

use App\Services\RoleService;

// Create an instance of the RoleService
$roleService = new RoleService();

// View a role
$role = $roleService->viewRole('admin');

// View a user
$user = $roleService->viewUser(1);

// Update a role's name
$roleService->updateRoleName('editor', 'content-editor');

// View permissions of a role
$permissions = $roleService->viewPermissionsForRole('admin');
*/
