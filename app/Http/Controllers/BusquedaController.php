<?php

namespace App\Http\Controllers;

//Modelos
use App\Models\Consignacion;

class BusquedaController extends Controller
{
    private array $Busqueda = array();
    private array $ClausulasWhere = array();

    public array $BusquedaConsignacion = array(
        'Averiguacion' => '',
        'ID_Detenido' => 0, //0 = Busqueda General, 1 = Con Detenido, 2 = Sin Detenido
        'ID_Agencia' => 0,
    );

    public function __construct()
    {
        $this->ClausulasWhere = array(
            'Averiguacion' => ['Averiguacion', 'like', '%' . $this->BusquedaConsignacion['Averiguacion'] . '%'],
        );
        return $this;
    }

    public function Consignacion($Paginate = true)
    {
        foreach ($this->BusquedaConsignacion as $key => $value) {
            if (isset($this->ClausulasWhere[$key])) {
                array_push($this->Busqueda, $this->ClausulasWhere[$key]);
            }
        }

        if ($Paginate) {
            return Consignacion::select('ID_Consignacion')
                ->join('averiguacion_previa', 'consignacion.ID_Averiguacion', '=', 'averiguacion_previa.ID_Averiguacion')
                ->where($this->Busqueda)->paginate();
        } else {
            return Consignacion::select('ID_Consignacion')
                ->join('averiguacion_previa', 'consignacion.ID_Averiguacion', '=', 'averiguacion_previa.ID_Averiguacion')
                ->where($this->Busqueda)->get()->json();
        }
    }
}
