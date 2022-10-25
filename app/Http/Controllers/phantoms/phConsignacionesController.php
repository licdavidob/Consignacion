<?php
namespace App\Http\Controllers\phantoms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\ConsignacionController;

// Modelos
use App\Models\Agencia;
use App\Models\Reclusorio;
use App\Models\Juzgado;
use App\Models\Delito;

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
        return view('consignaciones.create', compact('agencias', 'reclusorios', 'juzgados'));
    }
    public function createPerson()
    {
        // $agencias = Agencia::select('Nombre', 'ID_Agencia')->get();
        // $reclusorios = Reclusorio::select('Nombre', 'ID_Reclusorio')->get();
        // $juzgados = Juzgado::select('Nombre', 'ID_Juzgado')->get();
        // return view('consignaciones.create', compact('agencias', 'reclusorios', 'juzgados'));
        // $datos = $request;
        // return $request;
        return view('consignaciones.createPerson');
    }

    public function storePerson()
    {
        // $request->name;
        $dato = 'Pepito';
        return $dato;
        // var_dump($request);
        // return $request;
        // return view('consignaciones.create', compact('datos'));
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

        $datos = array(
            'Fecha' => $request->fecha_recibo,
            'Agencia' => $request->agencia,
            'Fojas' => $request->fojas,
            'Av_Previa' => $request->averiguacion,
            'Detenido' => $request->con_detenido,
            'Juzgado' => $request->juzgado,
            'Reclusorio' => $request->reclusorio,
            'Antecedente' => array([
                'Juzgado' => $request->agencia_Ant,
                'Fecha' => $request->fecha_recibo_Ant,
                'Detenido' => $request->con_detenido_Ant,
            ]),
            'Personas' => array([
                "Nombre" => 'Uriel',
                "Ap_Paterno" => 'Sanjuan',
                "Ap_Materno" => 'Morales',
                "Calidad" => '1',
                "Alias" => array(['Nombre','nombre2']),
            ]),
            'Delitos' => array(1, 4, 9),
            'Hora_Recibo' => $request->horaRecibo,
            'Hora_Entrega' => $request->horaEntrega,
            'Hora_Salida' => $request->horaSalida,
            'Hora_Regreso' => $request->hora_regreso,
            'Hora_Llegada' => $request->horaLlegada,
            'Fecha_Entrega' => $request->fechaEntrega,
            'Nota' => $request->notas,
        );

        $consignacion = new ConsignacionController;
        return $consignacion->store($request);
    }

    public function destroy($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->destroy($consignacionId);
        $consignaciones;
        return back();
    }

}
