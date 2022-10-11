<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Juzgado;

class JuzgadoController extends Controller
{
    public function index()
    {
        return  Juzgado::addSelect('ID_Juzgado','Nombre')->get();
    }
}
