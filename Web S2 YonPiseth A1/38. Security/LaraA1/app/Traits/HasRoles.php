<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function hasPermissionTo($permission)
    {
        if (is_string($permission)) {
            return $this->hasRole(
                $this->roles->whereHas('permissions', function ($query) use ($permission) {
                    $query->where('name', $permission);
                })
            );
        }

        return !! $permission->intersect($this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->whereIn('name', $permission->pluck('name')->toArray());
        })->get())->count();
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }
}
