<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Averiguacion_Previa;

class AveriguacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($Av_Previa)
    {
       Averiguacion_Previa::create([
        'Averiguacion' => $Av_Previa,
       ]);
       
       return Averiguacion_Previa::latest('ID_Averiguacion')->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($Averiguación,$id)
    {
        $AveriguacionBusqueda = Averiguacion_Previa::find($id);
        if($AveriguacionBusqueda){
            $AveriguacionBusqueda->Averiguacion = $Averiguación;
            $AveriguacionBusqueda->save();
        }else{
            echo "Error: No se encontró averiguación asignada a la consignación";
            exit();
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
