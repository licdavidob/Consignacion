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
    /**
     * Función que devuelve todas las consignaciones
     * 
     * @param $request
     * @return array|view
     */
    public function index(Request $request)
    {
        // Creamos una instancia de consignación
        $consignacion = new ConsignacionController;
        // Módulo de búsqueda
        if ($request->averiguacion === NULL) {
            $Averiguacion = '';
        }
        else {
            $consignacion->Busqueda['Averiguacion'] = $request->averiguacion;
        }
        // Llamando al controlador index para devolver las consignaciones de la base de datos
        $consignaciones = $consignacion->index();
        return view('consignaciones.index', compact('consignaciones'));
    }

    /**
     * Devuelve la vista de una consignación específica
     *
     * @param int $consignacionId
     * @return array|view
     */
    public function show($consignacionId)
    {
        // Llamamos al controlador y al método show
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->show($consignacionId);
        return view('consignaciones.show', compact('consignaciones'));
    }

    /**
     * Vista de la creación de una consignación
     *
     * @param void
     * @return view|array
     */
    public function create()
    {
        $agencias = Agencia::select('Nombre', 'ID_Agencia')->get();
        $reclusorios = Reclusorio::select('Nombre', 'ID_Reclusorio')->get();
        $juzgados = Juzgado::select('Nombre', 'ID_Juzgado')->get();
        $delitos = Delito::select('Nombre', 'ID_Delito')->get();
        $tipoParticipante = Calidad_Juridica::select('Calidad', 'ID_Calidad')->get();
        return view('consignaciones.create', compact('agencias', 'reclusorios', 'juzgados', 'delitos', 'tipoParticipante'));
    }

    /**
     * Función que guarda una nueva consignación
     *
     * @param Request request recibe los datos del formulario
     * @return void
     */
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
            // TODO: Hacer la modificación de forma dinámica y no nombres específicos
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
                ],),
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

    /**
     * Vista de la edición de una consignación
     *
     *@param int $consignacionId Recibe el id de la consignación
     *@return array|view Devuelve la vista consignaciones con los datos de los modelos
     */
    public function edit($consignacionId)
    {

        // Se llama al controlador consiginación y el método show
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->show($consignacionId);

        // Recuperamos los datos de los modelos para la vista de los catálogos
        // Agencias
        $agencias = Agencia::select('Nombre', 'ID_Agencia')->get();
        $agenciaID = Agencia::select('ID_Agencia')->where('Nombre', $consignaciones['Agencia'])->get();
        // Reclusorios
        $reclusorios = Reclusorio::select('Nombre', 'ID_Reclusorio')->get();
        $reclusoriosID = Reclusorio::select('ID_Reclusorio')->where('Nombre', $consignaciones['Reclusorio'])->get();
        // Juzgados
        $juzgados = Juzgado::select('Nombre', 'ID_Juzgado')->get();
        $juzgadosID = Juzgado::select('ID_Juzgado')->where('Nombre', $consignaciones['Juzgado'])->get();
        $juzgadoAntecedente = Juzgado::select('ID_Juzgado')->where('Nombre', $consignaciones['Antecedente']['Juzgado'])->get();
        // Delitos
        $delitos = Delito::select('Nombre', 'ID_Delito')->get();
        // Calidad de participante
        $tipoParticipante = Calidad_Juridica::select('Calidad', 'ID_Calidad')->get();
        return view('consignaciones.edit', compact('agencias', 'reclusorios', 'juzgados', 'delitos', 'tipoParticipante', 'consignaciones', 'consignacionId', 'juzgadosID', 'juzgadoAntecedente', 'agenciaID', 'reclusoriosID'));
    }

    /**
     *Función que realiza la actualización de la información de una consignación
     *
     *@param Request|int $consignacionId Recibe los datos del formulario y recibe el id de la consignación a modificar 
     *@return array|view Devuelve la vista consignaciones con los datos de los modelos
     */
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
        // RECUPERACIÓN de datos específicos
        // Personas
        $personasRequest= $request->except('Fecha', '_method','_token', 'Av_Previa', 'Detenido', 'Agencia', 'Reclusorio', 'Juzgado', 'Fojas', 'Delitos', 'Detenido_Ant', 'Juzgado_Ant', 'Fecha_Ant', 'Hora_Recibo', 'Hora_Entrega', 'Hora_Salida', 'Hora_Regreso', 'Hora_Llegada', 'Fecha_Entrega', 'Nota', 'Antecedente', 'contador');
        // Función que construye el arreglo de personas
        $personas = array();
        foreach ($personasRequest as $persona) {
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
        // Antecedente
        $antecedenteRequest = $request->only('Antecedente');
        // Función que construye el arreglo antecedentes
        foreach ($antecedenteRequest as $antecedente) {
            $antecedente = array(
            'Detenido' => $antecedente[0],
            'Juzgado' => intval($antecedente[1]),
            'Fecha' => $antecedente[2]
            );
        }
        // AJUSTES especiales de datos
        $antecedente['Detenido'] = $antecedente['Detenido'] == 'No'?  2: 1;
        $request->Detenido = $request->Detenido == 'No' ? 2: 1;
        // Cambiando a enteros datos de request
        $delitos = intval($request->Delitos[0]);
        $agencia = intval($request->Agencia);
        $juzgado = intval($request->Juzgado);
        $reclusorio = intval($request->Reclusorio);
        // CONSTRUCCIÓN del arreglo
        $datos = array(
            'Fecha' => $request->Fecha,
            'Agencia' => $agencia,
            'Fojas' => $request->Fojas,
            'Av_Previa' => $request->Av_Previa,
            'Detenido' => $request->Detenido,
            'Juzgado' => $juzgado,
            'Reclusorio' => $reclusorio,
            'Antecedente' => $antecedente,
            'Personas' => $personas,
            'Delitos' =>  array($delitos),
            'Hora_Recibo' => $request->Hora_Recibo,
            'Hora_Entrega' => $request->Hora_Entrega,
            'Hora_Salida' => $request->Hora_Salida,
            'Hora_Regreso' => $request->Hora_Regreso,
            'Hora_Llegada' => $request->Hora_Llegada,
            'Fecha_Entrega' => $request->Fecha_Entrega,
            'Nota' => $request->Nota,
            );
        // Llamando al controlador consignación y al método Update
        $consignacion = new ConsignacionController;
        $consignacion->update($datos, $consignacionId);
        return to_route('dashboard');
    }

    /**
     * Función que elimina la consignación
     *
     *@param int $consignacionId Recibe el ID de la consignación
     *@return void Regresa al index
     */
    public function destroy($consignacionId)
    {
        $consignacion = new ConsignacionController;
        $consignaciones = $consignacion->destroy($consignacionId);
        $consignaciones;
        return back();
    }

}
// TODO: Buscar sobre las variables de sesión para trabajar con búsquedas que queden almacenadas