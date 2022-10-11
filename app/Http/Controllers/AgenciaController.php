<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Agencia;

class AgenciaController extends Controller
{
    public function index()
    {
        return  Agencia::addSelect('ID_Agencia','Nombre')->get();
    }
}
