<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creación de roles
        $admin = Role::create(['name' => 'Admin']);
        $creador = Role::create(['name' => 'Creador']);
        $editor = Role::create(['name' => 'Editor']);
        $user = Role::create(['name' => 'User']);
        // Creación de permisos
        Permission::create(['name' => 'consignacion.index'])->syncRoles([$admin,$user,$editor,$creador]);
        Permission::create(['name' => 'consignacion.crear'])->syncRoles([$admin,$creador]);
        Permission::create(['name' => 'consignacion.guardar'])->syncRoles([$admin,$creador]);
        Permission::create(['name' => 'consignacion.mostrar'])->syncRoles([$admin,$user,$editor,$creador]);
        Permission::create(['name' => 'consignacion.editar'])->syncRoles([$admin,$editor,$creador]);
        Permission::create(['name' => 'consignacion.actualizar'])->syncRoles([$admin,$editor,$creador]);
        Permission::create(['name' => 'consignacion.destroy'])->syncRoles([$admin]);
        
        // Permisos de usuarios
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$admin]);



    }
}
