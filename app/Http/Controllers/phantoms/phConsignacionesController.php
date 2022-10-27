<?php

namespace App\Http\Controllers\phantoms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Controladores principales
use App\Http\Controllers\ConsignacionController;

// Modelos
use App\Models\Agencia;
use App\Models\Reclusorio;
use App\Models\Juzgado;
use App\Models\Delito;
use App\Models\Calidad_Juridica;

class phConsignacionesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->averiguacion === NULL) {
            $Averiguacion = '';
        }
        else {
            $Averiguacion = $request->averiguacion;
        }
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->index($Averiguacion);
        return view('consignaciones.index', compact('consignaciones'));

    }
    public function show($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->show($consignacionId);
        return view('consignaciones.show', compact('consignaciones'));
    }

    public function create()
    {
        $agencias = Agencia::select('Nombre', 'ID_Agencia')->get();
        $reclusorios = Reclusorio::select('Nombre', 'ID_Reclusorio')->get();
        $juzgados = Juzgado::select('Nombre', 'ID_Juzgado')->get();
        $delitos = Delito::select('Nombre', 'ID_Delito')->get();
        $tipoParticipante = Calidad_Juridica::select('Calidad', 'ID_Calidad')->get();
        return view('consignaciones.create', compact('agencias', 'reclusorios', 'juzgados', 'delitos', 'tipoParticipante'));
    }
    public function store(Request $request)
    {

        // VALIDACION DE ENTRADAS
        $request->validate([
            //VALIDACION Datos generales
            'Reclusorio' => 'required',
            'Av_Previa'  => 'required',
            'Detenido'   => 'required',
            'Juzgado'    => 'required',
            'Agencia'    => 'required',
            'Fecha'      => 'required',
            'Fojas'      => 'required',
            //VALIDACION Personas
            'Ap_Paterno0' => 'required',
            'Ap_Materno0' => 'required',
            'Calidad0'    => 'required',
            'Nombre0'     => 'required',
            'Alias0'      => 'required',
            'Ap_Paterno1' => 'required',
            'Ap_Materno1' => 'required',
            'Calidad1'    => 'required',
            'Nombre1'     => 'required',
            'Alias1'      => 'required',
            //VALIDACION Delitos
            'Delitos'      => 'required',
            //VALIDACION Antecedentes
            'Detenido_Ant' => 'required',
            'Juzgado_Ant'  => 'required',
            'Fecha_Ant'    => 'required',
            // VALIDACION Datos adicionales
            'Fecha_Entrega' => 'required',
            'Hora_Entrega'  => 'required',
            'Hora_Llegada'  => 'required',
            'Hora_Regreso'  => 'required',
            'Hora_Recibo'   => 'required',
            'Hora_Salida'   => 'required',
            'Nota'          => 'required',
        ]);

        // CONSTRUCCIÓN de la consignación 
        $datos = array(
            'Fecha' => $request->Fecha,
            'Agencia' => $request->Agencia,
            'Fojas' => $request->Fojas,
            'Av_Previa' => $request->Av_Previa,
            'Detenido' => $request->Detenido,
            'Juzgado' => $request->Juzgado,
            'Reclusorio' => $request->Reclusorio,
            'Antecedente' => array(
                'Juzgado' => $request->Juzgado_Ant,
                'Fecha' => $request->Fecha_Ant,
                'Detenido' => $request->Detenido_Ant,
            ),
            'Personas' => array(
                [
                "Nombre" => $request->Nombre0,
                "Ap_Paterno" => $request->Ap_Paterno0,
                "Ap_Materno" => $request->Ap_Materno0,
                "Calidad" => $request->Calidad0,
                "Alias" => array($request->Alias0)
                ],
                [
                    "Nombre" => $request->Nombre1,
                    "Ap_Paterno" => $request->Ap_Paterno1,
                    "Ap_Materno" => $request->Ap_Materno1,
                    "Calidad" => $request->Calidad1,
                    "Alias" => array($request->Alias1)
                ],
                // [
                //     "Nombre" => $request->Nombre2,
                //     "Ap_Paterno" => $request->Ap_Paterno2,
                //     "Ap_Materno" => $request->Ap_Materno2,
                //     "Calidad" => $request->Calidad2,
                //     "Alias" => array($request->Alias2)
                // ],
                // [
                //     "Nombre" => $request->Nombre3,
                //     "Ap_Paterno" => $request->Ap_Paterno3,
                //     "Ap_Materno" => $request->Ap_Materno3,
                //     "Calidad" => $request->Calidad3,
                //     "Alias" => array($request->Alias3)
                // ],
                // [
                //     "Nombre" => $request->Nombre4,
                //     "Ap_Paterno" => $request->Ap_Paterno4,
                //     "Ap_Materno" => $request->Ap_Materno4,
                //     "Calidad" => $request->Calidad4,
                //     "Alias" => array($request->Alias4)
                // ]
            ),
            'Delitos' =>  array(intval($request->Delitos)),
            'Hora_Recibo' => $request->Hora_Recibo,
            'Hora_Entrega' => $request->Hora_Entrega,
            'Hora_Salida' => $request->Hora_Salida,
            'Hora_Regreso' => $request->Hora_Regreso,
            'Hora_Llegada' => $request->Hora_Llegada,
            'Fecha_Entrega' => $request->Fecha_Entrega,
            'Nota' => $request->Nota,
        );

        // Envío de datos al controlador de consignaciones
        $consignacion = new ConsignacionController;
        $consignacion->store($datos);
        return to_route('dashboard');

    }

    public function destroy($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->destroy($consignacionId);
        $consignaciones;
        return back();
    }

}