<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\Consignacion;

//Controladores
use App\Http\Controllers\AveriguacionController;
use App\Http\Controllers\AntecedenteController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\DelitoController;

class ConsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($Av_Previa = '', $Detenido = 0, $Agencia = 0)
    {
        $Consignacion_Busqueda = $this->QueryBuilder($Av_Previa, $Detenido, $Agencia);
        $Consignaciones = array();
        $i = 0;
        foreach ($Consignacion_Busqueda as $Consignacion) {
            $Agencia = $Consignacion->Agencia()->select('Nombre')->get();

            $Consignacion['Con Detenido'] = $Consignacion->Detenido == 1 ? 'Con Detenido' : 'Sin Detenido';
            $Consignacion['Agencia'] = $Agencia[0]["Nombre"];
            $Consignacion['Averiguacion'] = $Consignacion->Averiguacion;
            $Consignaciones[$i] = $Consignacion;
            $i++;
        }
        return json_encode($Consignaciones);
    }

    public function QueryBuilder($Av_Previa, $Detenido, $Agencia)
    {
        $Operador_Detenido = $Detenido == 0 ? '>=' : '=';
        $Operador_Agencia = $Agencia == 0 ? '>=' : '=';
        $Consignaciones = Consignacion::select('ID_Consignacion', 'ID_Agencia', 'Averiguacion', 'ID_Juzgado', 'Detenido')
            ->join('averiguacion_previa', 'consignacion.ID_Averiguacion', '=', 'averiguacion_previa.ID_Averiguacion')
            ->where('Detenido', $Operador_Detenido, $Detenido)
            ->where('ID_Agencia', $Operador_Agencia, $Agencia)
            ->Where('Averiguacion', 'like', '%' . $Av_Previa . '%')
            ->Where('Estatus', 1)
            ->get();
        return $Consignaciones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requdft  $request
     * @return \Illuminate\Http\Response
     */
    public function store($Consignacion)
    {
        //Se obtiene la informacion de la averiguacion previa insertada
        $Averiguacion = new AveriguacionController;
        $Averiguacion = $Averiguacion->store($Consignacion->Av_Previa);

        //Se registra la consignación
        Consignacion::create([
            'Fecha' => $Consignacion->Fecha,
            'ID_Agencia' => $Consignacion->Agencia,
            'Fojas' => $Consignacion->Fojas,
            'ID_Averiguacion' => $Averiguacion['ID_Averiguacion'],
            'Detenido' => $Consignacion->Detenido,
            'ID_Juzgado' => $Consignacion->Juzgado,
            'ID_Reclusorio' => $Consignacion->Reclusorio,
            'Hora_Recibo' => $Consignacion->Hora_Recibo,
            'Hora_Entrega' => $Consignacion->Hora_Entrega,
            'Hora_Salida' => $Consignacion->Hora_Salida,
            'Hora_Regreso' => $Consignacion->Hora_Regreso,
            'Hora_Llegada' => $Consignacion->Hora_Llegada,
            'Fecha_Entrega' => $Consignacion->Fecha_Entrega,
            'Nota' => $Consignacion->Nota,
        ]);

        //Se obtiene la informacion de la Consignacion insertada
        $Consignacion_Insertada = Consignacion::latest('ID_Consignacion')->first();

        //Si existe un antecedente, se registra
        if ($Consignacion->Antecedente) {
            $Antecedente = new AntecedenteController;
            $Antecedente->store($Consignacion->Antecedente, $Consignacion_Insertada['ID_Consignacion']);
        }

        //Si tiene a personas relacionadas a la consignación, se registran
        if ($Consignacion->Personas) {
            $Persona = new PersonaController;
            $Persona->store($Consignacion->Personas, $Consignacion_Insertada['ID_Consignacion']);
        }

        //Si tiene delitos la consignación, se registran a la tabla pivote
        if ($Consignacion->Delitos) {
            foreach ($Consignacion->Delitos as $Delito) {
                $Consignacion_Insertada->Delito()->attach($Delito);
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
        $AntecedenteBusqueda = new AntecedenteController;
        $Persona = new PersonaController;
        $Delito = new DelitoController;

        $ConsignacionBusqueda = Consignacion::findOrFail($id);

        if ($ConsignacionBusqueda->Estatus == 1) {

            $Antecedente = $AntecedenteBusqueda->show($ConsignacionBusqueda['ID_Consignacion']);
            $Agencia = $ConsignacionBusqueda->Agencia()->select('Nombre')->get();
            $Juzgado = $ConsignacionBusqueda->Juzgado()->select('Nombre')->get();
            $Reclusorio = $ConsignacionBusqueda->Reclusorio()->select('Nombre')->get();
            $Averiguacion = $ConsignacionBusqueda->Averiguacion()->select('Averiguacion')->get();
            $Personas = $Persona->SearchEachPersonaByConsignacion($ConsignacionBusqueda['ID_Consignacion']);
            $Delitos = $Delito->show($ConsignacionBusqueda);

            $Consignacion['Fecha'] = $ConsignacionBusqueda->Fecha;
            $Consignacion['Agencia'] = $Agencia[0]["Nombre"];
            $Consignacion['Fojas'] = $ConsignacionBusqueda->Fojas;
            $Consignacion['Av_Previa'] = $Averiguacion[0]["Averiguacion"];
            $Consignacion['Detenido'] = $ConsignacionBusqueda->Detenido == 1 ? 'Si' : 'No';
            $Consignacion['Juzgado'] = $Juzgado[0]["Nombre"];
            $Consignacion['Reclusorio'] = $Reclusorio[0]["Nombre"];
            $Consignacion['Antecedente'] = $Antecedente;
            $Consignacion['Personas'] = $Personas;
            $Consignacion['Delitos'] = $Delitos;
            $Consignacion['Hora_Recibo'] = $ConsignacionBusqueda->Hora_Recibo ?: '';
            $Consignacion['Hora_Entrega'] = $ConsignacionBusqueda->Hora_Entrega ?: '';
            $Consignacion['Hora_Salida'] = $ConsignacionBusqueda->Hora_Salida ?: '';
            $Consignacion['Hora_Regreso'] = $ConsignacionBusqueda->Hora_Regreso ?: '';
            $Consignacion['Hora_Llegada'] = $ConsignacionBusqueda->Hora_Llegada ?: '';
            $Consignacion['Fecha_Entrega'] = $ConsignacionBusqueda->Fecha_Entrega ?: '';
            $Consignacion['Nota'] = $ConsignacionBusqueda->Nota ?: '';

            return $Consignacion;
        } else {
            return "Esa consignación se encuentra desactivada";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($ConsignacionActualizada, $id)
    {
        $ConsignacionBusqueda = Consignacion::findOrFail($id);

        //Si la consignación es activa, se puede actualizar
        if ($ConsignacionBusqueda->Estatus == 1) {

            //Se actualiza la informacion de la averiguacion previa
            $Averiguacion = new AveriguacionController;
            $Averiguacion = $Averiguacion->update($ConsignacionActualizada->Av_Previa, $ConsignacionBusqueda->ID_Averiguacion);

            //Se actualiza la información del antecedente, en caso de no existir, se registra el antecedente
            $Antecedente = new AntecedenteController;
            $Antecedente->ValidarActualizacion($ConsignacionActualizada->Antecedente, $ConsignacionBusqueda->ID_Consignacion);

            //Se actualiza la información de las personas, en caso de no existir, se registra a la persona
            $Persona = new PersonaController;
            $Persona->ValidarActualizacion($ConsignacionActualizada->Personas, $ConsignacionBusqueda->ID_Consignacion);

            //Se actualiza la información de los delitos
            $Delitos = new DelitoController;
            $Delitos->UpdateDelitoByConsignacion($ConsignacionActualizada->Delitos, $ConsignacionBusqueda);

            //Se actualiza el resto de la consignación
            $ConsignacionBusqueda->Fecha = $ConsignacionActualizada->Fecha;
            $ConsignacionBusqueda->ID_Agencia = $ConsignacionActualizada->Agencia;
            $ConsignacionBusqueda->Fojas = $ConsignacionActualizada->Fojas;
            $ConsignacionBusqueda->Detenido = $ConsignacionActualizada->Detenido;
            $ConsignacionBusqueda->ID_Juzgado = $ConsignacionActualizada->Juzgado;
            $ConsignacionBusqueda->ID_Reclusorio = $ConsignacionActualizada->Reclusorio;
            $ConsignacionBusqueda->Hora_Recibo = $ConsignacionActualizada->Hora_Recibo;
            $ConsignacionBusqueda->Hora_Entrega = $ConsignacionActualizada->Hora_Entrega;
            $ConsignacionBusqueda->Hora_Salida = $ConsignacionActualizada->Hora_Salida;
            $ConsignacionBusqueda->Hora_Regreso = $ConsignacionActualizada->Hora_Regreso;
            $ConsignacionBusqueda->Hora_Llegada = $ConsignacionActualizada->Hora_Llegada;
            $ConsignacionBusqueda->Fecha_Entrega = $ConsignacionActualizada->Fecha_Entrega;
            $ConsignacionBusqueda->Nota = $ConsignacionActualizada->Nota;
            $ConsignacionBusqueda->save();
        } else {
            return "Esa consignación se encuentra desactivada";
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
        $Consignacion = Consignacion::findOrFail($id);
        $Consignacion->Estatus = 0;
        $Consignacion->save();
    }
}
