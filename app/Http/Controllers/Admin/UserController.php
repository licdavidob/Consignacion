<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.index');
        // $this->authorize(['Admin']);
    }

    // Si colocamos $user se regresa solo el id del usuario 
    // Si colocamos el objeto recibimos toda la información del usuario
    public function edit(User $user)
    {
        // return $user;
        $roles = Role::all();
        // return $roles;
        return view('admin.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user)->with('info', 'Se asignaron los roles correctamente');
    }
}
