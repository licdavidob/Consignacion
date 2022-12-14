<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Delito;

class DelitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Delito::addSelect('ID_Delito', 'Nombre')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $Consignacion
     * @return array
     */
    public function show($Consignacion)
    {
        $Delitos = array();
        $DelitoBusqueda = $Consignacion->Delito()->select('Nombre')->get();
        $i = 0;
        foreach ($DelitoBusqueda as $Delito) {
            $Datos['Nombre'] = $Delito['Nombre'];
            $Datos['ID_Delito'] = $Delito['pivot']['ID_Delito'];
            $Delitos[$i] = $Datos;
            $i++;
        }
        return $Delitos;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function UpdateDelitoByConsignacion($NuevosDelitos, $ConsignacionBusqueda)
    {
        if ($NuevosDelitos) {
            $ConsignacionBusqueda->Delito()->detach();
            foreach ($NuevosDelitos as $Delito) {
                $ConsignacionBusqueda->Delito()->attach($Delito);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
