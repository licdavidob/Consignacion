<?php

namespace App\Http\Controllers\phantoms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\ConsignacionController;

// Modelos
use App\Models\Agencia;
use App\Models\Reclusorio;
use App\Models\Juzgado;
use App\Models\Delito;
use App\Models\Calidad_Juridica;

class phConsignacionesController extends Controller
{
    // public function index(Request $request)
    public function index()
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->index();
        return view('consignaciones.index', ['consignaciones' => $consignaciones]);
    }
    public function show($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->show($consignacionId);
        // return view('consignaciones.show', compact('consignaciones'));
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
    public function createPerson()
    {
        return view('consignaciones.createPerson');
    }

    public function storePerson(Request $request)
    {
        // $timecookie = 1;
        // $response = new Response();
        // $response->withCookie(cookie('nombrePersona', $request->name, $timecookie));
        // return $response;
    }

    public function createDelito()
    {
        $delitos = Delito::select('Nombre', 'ID_Delito')->get();
        // $reclusorios = Reclusorio::select('Nombre', 'ID_Reclusorio')->get();
        // $juzgados = Juzgado::select('Nombre', 'ID_Juzgado')->get();
        // return view('consignaciones.create', compact('agencias', 'reclusorios', 'juzgados'));
        return view('consignaciones.createDelito', compact('delitos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'Av_Previa' => 'required',
            'Detenido' => 'required',
            'Agencia' => 'required',
            'Fecha' => 'required',
            'Reclusorio' => 'required',
            'Juzgado' => 'required',
            'Fojas' => 'required',
            'Nombre0' => 'required',
            'Ap_Paterno0' => 'required',
            'Ap_Materno0' => 'required',
            'Calidad0' => 'required',
            'Alias0' => 'required',
            'Nota' => 'required',
        ]);
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
                ],[
                    "Nombre" => $request->Nombre1,
                    "Ap_Paterno" => $request->Ap_Paterno1,
                    "Ap_Materno" => $request->Ap_Materno1,
                    "Calidad" => $request->Calidad1,
                    "Alias" => array($request->Alias1)
                ],
                [
                    "Nombre" => $request->Nombre2,
                    "Ap_Paterno" => $request->Ap_Paterno2,
                    "Ap_Materno" => $request->Ap_Materno2,
                    "Calidad" => $request->Calidad2,
                    "Alias" => array($request->Alias2)
                ],
                [
                    "Nombre" => $request->Nombre3,
                    "Ap_Paterno" => $request->Ap_Paterno3,
                    "Ap_Materno" => $request->Ap_Materno3,
                    "Calidad" => $request->Calidad3,
                    "Alias" => array($request->Alias3)
                ],
                [
                    "Nombre" => $request->Nombre4,
                    "Ap_Paterno" => $request->Ap_Paterno4,
                    "Ap_Materno" => $request->Ap_Materno4,
                    "Calidad" => $request->Calidad4,
                    "Alias" => array($request->Alias4)
                ]
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

        // return $datos;

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