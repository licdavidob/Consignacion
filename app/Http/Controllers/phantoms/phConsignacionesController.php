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
        // return 'cadena';
    }
    
    public function show($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->show($consignacionId);
        return $consignaciones;
        // var_dump($consignaciones);
        // return $consignacion;
    }

    public function create()
    {
        return view('consignaciones.create');
    }

    public function store(Request $request)
    {
        $consignacion = new ConsignacionController;
        $consignacion->store($request);

        // return $request;
        // return 'success';
        // return view('consignaciones.index', ['consignaciones' => $consignaciones ]);
        // return 'cadena';
    }

    public function destroy($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->destroy($consignacionId);
        return $consignaciones;
    }

}
