<?php

namespace App\Http\Controllers;

use App\Models\Antecedente;
use Illuminate\Http\Request;

class AntecedenteController extends Controller
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
    public function store($Antecedente, $Consignacion)
    {
        Antecedente::create([
            'Fecha_Antecendente' => $Antecedente['Fecha'],
            'Detenido' => $Antecedente['Detenido'],
            'ID_Juzgado' => $Antecedente['Juzgado'],
            'ID_Consignacion' => $Consignacion,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Antecedente = array();
        $AntecedenteBusqueda = Antecedente::select('Fecha_Antecendente', 'ID_Juzgado', 'Detenido')->where('ID_Consignacion', $id)->with('Juzgado')->first();
        if ($AntecedenteBusqueda->exists()) {
            $Juzgado = $AntecedenteBusqueda['Juzgado'];
            $Antecedente['Fecha'] = $AntecedenteBusqueda->Fecha_Antecendente;
            $Antecedente['Con Detenido'] = $AntecedenteBusqueda->Detenido == 1 ? 'Si' : 'No';
            $Antecedente['Juzgado'] = $Juzgado['Nombre'];
        }

        return $Antecedente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($AntecedenteBusqueda, $AntecedenteActualizada)
    {
        $AntecedenteBusqueda->ID_Juzgado = $AntecedenteActualizada['Juzgado'];
        $AntecedenteBusqueda->Fecha_Antecendente = $AntecedenteActualizada['Fecha'];
        $AntecedenteBusqueda->Detenido = $AntecedenteActualizada['Detenido'];
        $AntecedenteBusqueda->save();
    }

    public function ValidarActualizacion($AntecedenteActualizada, $ID_Consignacion)
    {

        $AntecedenteBD = Antecedente::where('ID_Consignacion', $ID_Consignacion)->first();
        //Si existe el antecedente en la petición y existe registro en la BD, se actualiza
        if ($AntecedenteBD && $AntecedenteActualizada) {
            $this->update($AntecedenteBD, $AntecedenteActualizada);
        } else {
            //Se verifica que exista un antecedente en la petición, para que sea guardada
            if ($AntecedenteActualizada) {
                $this->store($AntecedenteActualizada, $ID_Consignacion);
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
