<?php

namespace App\Http\Controllers\phantoms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\ConsignacionController;

class phConsignacionesController extends Controller
{
    public function index()
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->index();
        // return $consignaciones;

        return view('consignaciones.index', ['consignaciones' => $consignaciones ]);
        // return view('consignaciones.index');
    }
}
