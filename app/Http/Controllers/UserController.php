<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//Modelos
use App\Models\User;

class UserController extends Controller
{
    /**
     * Muestra todos los usuario registrados en el sistema.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(bool $Activate = true)
    {
        return "Metodo Index";
    }

    /**
     * Registra un nuevo usuario en sistema.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => 1,
            "msg" => "Se registro con éxito"
        ]);
    }

    /**
     * Muestra la información general de un usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Actualiza la información de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Desactiva a un usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Muestra la información general del usuario logueado actualmente
     */
    public static function logininfo()
    {
        return auth()->user();
    }
}
