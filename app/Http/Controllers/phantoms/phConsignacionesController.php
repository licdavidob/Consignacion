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
use App\Models\Consignacion;

class phConsignacionesController extends Controller
{
    public function index(Request $request)
    {
        $consignacion = new ConsignacionController;
        if ($request->averiguacion === NULL) {
            $Averiguacion = '';
        }
        else {
            $consignacion->Busqueda['Averiguacion'] = $request->averiguacion;
        }
        $consignaciones = $consignacion->index();
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

        // return $datos;

        // Envío de datos al controlador de consignaciones
        $consignacion = new ConsignacionController;
        $consignacion->store($datos);
        return to_route('dashboard');

    }

    public function edit($consignacionId)
    {

        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->show($consignacionId);

        // return $consignaciones;
        
        $agencias = Agencia::select('Nombre', 'ID_Agencia')->get();
        $agenciaID = Agencia::select('ID_Agencia')->where('Nombre', $consignaciones['Agencia'])->get();
        // return $agenciaID;
        $reclusorios = Reclusorio::select('Nombre', 'ID_Reclusorio')->get();
        $reclusoriosID = Reclusorio::select('ID_Reclusorio')->where('Nombre', $consignaciones['Reclusorio'])->get();
        // return $reclusoriosID;
        $juzgados = Juzgado::select('Nombre', 'ID_Juzgado')->get();
        $juzgadosID = Juzgado::select('ID_Juzgado')->where('Nombre', $consignaciones['Juzgado'])->get();
        $juzgadoAntecedente = Juzgado::select('ID_Juzgado')->where('Nombre', $consignaciones['Antecedente']['Juzgado'])->get();
        // return $juzgadoAntecedente;
        $delitos = Delito::select('Nombre', 'ID_Delito')->get();
        $tipoParticipante = Calidad_Juridica::select('Calidad', 'ID_Calidad')->get();
        // $tipoParticipanteID = Calidad_Juridica::select('ID_Calidad')->where('Calidad', $consignaciones['Personas']['Calidad'])->get();
        // return $tipoParticipanteID;
        return view('consignaciones.edit', compact('agencias', 'reclusorios', 'juzgados', 'delitos', 'tipoParticipante', 'consignaciones', 'consignacionId', 'juzgadosID', 'juzgadoAntecedente', 'agenciaID', 'reclusoriosID'));
    }
    
    public function update(Request $request, $consignacionId)
    {
        // VALIDACION DE ENTRADAS
        // $request->validate([
            //     //VALIDACION Datos generales
            //     'Reclusorio' => 'required',
            //     'Av_Previa'  => 'required',
            //     'Detenido'   => 'required',
            //     'Juzgado'    => 'required',
            //     'Agencia'    => 'required',
            //     'Fecha'      => 'required',
            //     'Fojas'      => 'required',
            //     //VALIDACION Personas
            //     'Ap_Paterno0' => 'required',
            //     'Ap_Materno0' => 'required',
            //     'Calidad0'    => 'required',
            //     'Nombre0'     => 'required',
            //     'Alias0'      => 'required',
            //     'Ap_Paterno1' => 'required',
            //     'Ap_Materno1' => 'required',
        //     'Calidad1'    => 'required',
        //     'Nombre1'     => 'required',
        //     'Alias1'      => 'required',
        //     //VALIDACION Delitos
        //     'Delitos'      => 'required',
        //     //VALIDACION Antecedentes
        //     'Detenido_Ant' => 'required',
        //     'Juzgado_Ant'  => 'required',
        //     'Fecha_Ant'    => 'required',
        //     // VALIDACION Datos adicionales
        //     'Fecha_Entrega' => 'required',
        //     'Hora_Entrega'  => 'required',
        //     'Hora_Llegada'  => 'required',
        //     'Hora_Regreso'  => 'required',
        //     'Hora_Recibo'   => 'required',
        //     'Hora_Salida'   => 'required',
        //     'Nota'          => 'required',
        // ]);
        // Construcción del arreglo de actualización
        
        // Recuperación de personas
        $personasRequest= $request->except('Fecha', '_method','_token', 'Av_Previa', 'Detenido', 'Agencia', 'Reclusorio', 'Juzgado', 'Fojas', 'Delitos', 'Detenido_Ant', 'Juzgado_Ant', 'Fecha_Ant', 'Hora_Recibo', 'Hora_Entrega', 'Hora_Salida', 'Hora_Regreso', 'Hora_Llegada', 'Fecha_Entrega', 'Nota', 'Antecedente', 'contador');
        // Función que construye el arreglo de personas
        $personas = array();
        foreach ($personasRequest as $persona) {
            // return $persona;
            $aux = array(
                'ID_Persona' => intval($persona[0]),
                'Nombre' => $persona[1],
                'Ap_Paterno' => $persona[2],
                'Ap_Materno' => $persona[3],
                'Calidad' => intval($persona[4]),
                'Alias' => array($persona[5]),
            );
            array_push($personas,$aux);
}

// Recuperación del arreglo Antecedente
$antecedenteRequest = $request->only('Antecedente');
// Función que construye el arreglo antecedentes
foreach ($antecedenteRequest as $antecedente) {
    $antecedente = array(
    'Detenido' => $antecedente[0],
    'Juzgado' => intval($antecedente[1]),
    'Fecha' => $antecedente[2]
);
}
// Ajuste de datos
$antecedente['Detenido'] = $antecedente['Detenido'] == 'No'?  2: 1;

$request->Detenido = $request->Detenido == 'No' ? 2: 1;


// Construcción del arreglo
        $datos = array(
            'Fecha' => $request->Fecha,
            'Agencia' => intval($request->Agencia),
            'Fojas' => $request->Fojas,
            'Av_Previa' => $request->Av_Previa,
            'Detenido' => $request->Detenido,
            'Juzgado' => intval($request->Juzgado),
            'Reclusorio' => intval($request->Reclusorio),
            'Antecedente' => $antecedente,
            'Personas' => $personas,
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
        // return $request;

        $consignacion = new ConsignacionController;
        $consignacion->update($datos, $consignacionId);
        return to_route('dashboard');

        // return print_r($nombres);
            // return $personas;
        // return $consignacionId;

    }

    public function destroy($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->destroy($consignacionId);
        $consignaciones;
        return back();
    }

}