<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Reclusorio;

class ReclusorioController extends Controller
{
    public function index()
    {
        return  Reclusorio::addSelect('ID_Reclusorio','Nombre')->get();
    }
}
