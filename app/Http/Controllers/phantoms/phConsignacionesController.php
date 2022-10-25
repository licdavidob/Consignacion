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

    public function storePerson(Request $request)
    {
        // var_dump($request);
        return $request;
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
        $consignaciones;
        return back();
    }

}
