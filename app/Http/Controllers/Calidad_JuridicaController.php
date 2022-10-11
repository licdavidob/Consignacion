<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Calidad_Juridica;

class Calidad_JuridicaController extends Controller
{
    public function index(){
        return  Calidad_Juridica::addSelect('ID_Calidad','Calidad')->get();
    }
}
