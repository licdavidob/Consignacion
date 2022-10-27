<?php

namespace App\Http\Controllers;

//Modelos
use App\Models\Consignacion;

//Controladores
use App\Http\Controllers\AveriguacionController;
use App\Http\Controllers\AntecedenteController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\DelitoController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ConsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $Av_Previa
     * @param int $Detenido
     * @param int $Agencia
     * @return array
     */
    public function index(string $Av_Previa = '', int $Detenido = 0, int $Agencia = 0)
    {
        return $this->QueryBuilderSearch($Av_Previa, $Detenido, $Agencia);
        // $Consignaciones = array();
        // $i = 0;
        // foreach ($Consignacion_Busqueda as $Consignacion) {
        //     $Agencia = $Consignacion->Agencia()->select('Nombre')->get();
        //     $Consignacion['Con Detenido'] = $Consignacion->Detenido == 1 ? 'Con Detenido' : 'Sin Detenido';
        //     $Consignacion['Agencia'] = $Agencia[0]["Nombre"];
        //     $Consignacion['Averiguacion'] = $Consignacion->Averiguacion;
        //     $Consignaciones[$i] = $Consignacion;
        //     $i++;
        // }
        // return $Consignaciones;
        //TODO: Arreglar esta vaina
    }

    /**
     *Se encarga de contruir un select con
     *los parámetros recibidos en el index
     *
     * @param string $Av_Previa
     * @param int $Detenido
     * @param int $Agencia
     * @return object
     */
    public function QueryBuilderSearch(string $Av_Previa, int $Detenido, int $Agencia): object
    {
        $Operador_Detenido = $Detenido == 0 ? '>=' : '=';
        $Operador_Agencia = $Agencia == 0 ? '>=' : '=';
        return Consignacion::select('ID_Consignacion', 'ID_Agencia', 'Averiguacion', 'ID_Juzgado', 'Detenido')
            ->join('averiguacion_previa', 'consignacion.ID_Averiguacion', '=', 'averiguacion_previa.ID_Averiguacion')
            ->where('Detenido', $Operador_Detenido, $Detenido)
            ->where('ID_Agencia', $Operador_Agencia, $Agencia)
            ->Where('Averiguacion', 'like', '%' . $Av_Previa . '%')
            ->Where('Estatus', 1)
            ->paginate(5);
    }

    /**
     * Se encarga de registrar una consignación
     * recibida mediante un JSON
     *
     * @param string $Consignacion
     * @return bool
     */

    public function store(array $Consignacion)
    {
        if ($Consignacion == '') {
            return false;
        }

        //Se obtiene la informacion de la averiguacion previa insertada
        $Averiguacion = new AveriguacionController;
        $Averiguacion = $Averiguacion->store($Consignacion['Av_Previa']);

        //        Se registra la consignación
        Consignacion::create([
            'Fecha' => $Consignacion['Fecha'],
            'ID_Agencia' => $Consignacion['Agencia'],
            'Fojas' => $Consignacion['Fojas'],
            'ID_Averiguacion' => $Averiguacion['ID_Averiguacion'],
            'Detenido' => $Consignacion['Detenido'],
            'ID_Juzgado' => $Consignacion['Juzgado'],
            'ID_Reclusorio' => $Consignacion['Reclusorio'],
            'Hora_Recibo' => $Consignacion['Hora_Recibo'],
            'Hora_Entrega' => $Consignacion['Hora_Entrega'],
            'Hora_Salida' => $Consignacion['Hora_Salida'],
            'Hora_Regreso' => $Consignacion['Hora_Regreso'],
            'Hora_Llegada' => $Consignacion['Hora_Llegada'],
            'Fecha_Entrega' => $Consignacion['Fecha_Entrega'],
            'Nota' => $Consignacion['Nota'],
        ]);

        //Se obtiene la informacion de la Consignacion insertada
        $Consignacion_Insertada = Consignacion::latest('ID_Consignacion')->first();

        //Si existe un antecedente, se registra
        if ($Consignacion['Antecedente']) {
            $Antecedente = new AntecedenteController;
            $Antecedente->store($Consignacion['Antecedente'], $Consignacion_Insertada['ID_Consignacion']);
        }

        //Si tiene a personas relacionadas a la consignación, se registran
        if ($Consignacion['Personas']) {
            $Persona = new PersonaController;
            $Persona->store($Consignacion['Personas'], $Consignacion_Insertada['ID_Consignacion']);
        }

        //Si tiene delitos la consignación, se registran a la tabla pivote
        if ($Consignacion['Delitos']) {
            foreach ($Consignacion['Delitos'] as $Delito) {
                $Consignacion_Insertada->Delito()->attach($Delito);
            }
        }
        return true;
    }

    /**
     * Muestra la información de una consignación
     * en específico.
     *
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        $AntecedenteBusqueda = new AntecedenteController;
        $Persona = new PersonaController;
        $Delito = new DelitoController;

        $ConsignacionBusqueda = Consignacion::findOrFail($id);
        $Consignacion['Error'] = '';

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
        } else {
            $Consignacion['Error'] = 'Esa consignación se encuentra desactivada';
        }
        return $Consignacion;
    }

    /**
     * Actualiza la información de una consignación. De igual manera, detecta
     * cambios nuevos en las personas involucradas y los registra
     *
     * @param string $ConsignacionActualizada
     * @param int $id
     * @return bool
     */
    public function update(string $ConsignacionActualizada, int $id): bool
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
            return false;
        }
        return true;
    }

    /**
     * Desactiva una consignación.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $Consignacion = Consignacion::findOrFail($id);
        $Consignacion->Estatus = 0;
        $Consignacion->save();
        return true;
    }
}
