<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Persona;

//Controladores
use App\Http\Controllers\AliasController;

class PersonaController extends Controller
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
    public function store($Personas, $Consignacion)
    {
        foreach ($Personas as $Persona) {
            $this->CreatePersona($Persona, $Consignacion);
        }
    }

    public function CreatePersona($Persona, $Consignacion)
    {
        Persona::create([
            'Nombre' => $Persona["Nombre"],
            'Ap_Paterno' => $Persona["Ap_Paterno"],
            'Ap_Materno' => $Persona["Ap_Materno"],
            'ID_Calidad' => $Persona['Calidad'],
            'ID_Consignacion' => $Consignacion,
        ]);

        //Se obtiene la informacion de la persona insertada
        $UltimaPersona = Persona::latest('ID_Persona')->first();

        //Si se tienen alias en la solicitud, se registran a las personas
        if ($Persona["Alias"]) {
            $GuardarAlias = new AliasController;
            foreach ($Persona["Alias"] as $Alias) {
                $Alias = $GuardarAlias->store($Alias);
                $UltimaPersona->Alias()->attach($Alias['ID_Alias']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i = 0;
        $BusquedaPersona = Persona::find($id);
        $Calidad = $BusquedaPersona->Calidad()->select('Calidad')->get();
        $Persona["ID_Persona"] = $BusquedaPersona->ID_Persona;
        $Persona["Nombre"] = $BusquedaPersona->Nombre;
        $Persona["Ap_Paterno"] = $BusquedaPersona->Ap_Paterno;
        $Persona["Ap_Materno"] = $BusquedaPersona->Ap_Materno;
        $Persona["Calidad"] = $Calidad[0]["Calidad"];
        $ConjuntoAlias = $BusquedaPersona->Alias;
        foreach ($ConjuntoAlias as $Auxiliar_Alias) {
            $Alias[$i] = $Auxiliar_Alias['Alias'];
            $i++;
        }
        $Persona["Alias"] = $Alias;

        return $Persona;
    }

    public function SearchEachPersonaByConsignacion($ID_Consignacion)
    {
        $BusquedaPersona = Persona::select('ID_Persona')->where('ID_Consignacion', $ID_Consignacion)->get();
        $Personas = array();
        $i = 0;
        foreach ($BusquedaPersona as $ID_Persona) {
            $Personas[$i] = $this->show($ID_Persona['ID_Persona']);
            $i++;
        }

        return $Personas;
    }

    /**
     * Update the specified resource in storage.
     *z
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($Persona, $id)
    {
        $BusquedaPersona = Persona::find($id);
        if ($BusquedaPersona) {
            $BusquedaPersona->Nombre = $Persona['Nombre'];
            $BusquedaPersona->Ap_Paterno = $Persona['Ap_Paterno'];
            $BusquedaPersona->Ap_Materno = $Persona['Ap_Materno'];
            $BusquedaPersona->ID_Calidad = $Persona['Calidad'];
            $BusquedaPersona->save();

            if ($Persona['Alias']) {
                $BusquedaPersona->Alias()->detach();
                $GuardarAlias = new AliasController;
                foreach ($Persona["Alias"] as $Alias) {
                    $Alias = $GuardarAlias->store($Alias);
                    $BusquedaPersona->Alias()->attach($Alias['ID_Alias']);
                }
            }
        } else {
            return "No existe esa persona";
        }
    }

    public function ValidarActualizacion($PersonasActualizada, $Consignacion)
    {
        foreach ($PersonasActualizada as $PersonaActualizada) {
            //Si la persona cuenta con un ID, entonces se va a actualizar el registro
            if (isset($PersonaActualizada['ID_Persona'])) {
                $this->update($PersonaActualizada, $PersonaActualizada['ID_Persona']);
            } else {
                //Si la persona NO cuenta con un ID, se registra
                $this->CreatePersona($PersonaActualizada, $Consignacion);
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
