<?php

namespace App\Http\Controllers;

//Modelos
use App\Models\Consignacion;

class BusquedaController extends Controller
{
    public array $BusquedaConsignacion;
    public bool $Paginate = true;
    private array $Busqueda = array();
    public array $ClausulasWhere;
    private string $Operador;

    public function __construct()
    {
        $this->BusquedaConsignacion = array(
            'Averiguacion' => '',
            'ID_Detenido' => 0, //0 = Busqueda General, 1 = Con Detenido, 2 = Sin Detenido
            'ID_Agencia' => 0,
            'Estatus' => 1,
        );
        $this->InicializarWhere();
    }

    /**
     * Se encarga de recorrer el parámetro de busqueda deseado y llamar a los métodos
     * correspondientes para preparar la busqueda de los mismos en la BD
     *
     * @param $Busqueda
     * @return bool
     */
    public function DefineBusqueda($Busqueda): bool
    {
        $i = 0;
        foreach ($Busqueda as $key => $value) {
            if (isset($this->ClausulasWhere[$key])) {
                $this->InicializarWhere($value);
                $this->DefineOperator($key, $Busqueda);
                $this->ModificarOperadorClausulasWhere($key);
                $this->Busqueda[] = $this->ClausulasWhere[$key];
            }

        }
        return true;
    }

    /**
     * Define el operador que se usará para la busqueda.
     * Si el valor a buscar es de tipo string, el operador será 'like'
     * Si el valor a buscar es de tipo entero:
     * '>=' si es 0 / '=' si es diferente de 0
     *
     * @param $keyBusqueda
     * @param $Busqueda
     * @return bool
     */
    public function DefineOperator($keyBusqueda, $Busqueda): bool
    {
        if (is_string($Busqueda[$keyBusqueda])) {
            $this->Operador = 'like';
        } else {
            $this->Operador = $Busqueda[$keyBusqueda] === 0 ? '>=' : '=';
        }
        return true;
    }

    /**
     * Modifica el operador a usar en $ClausulasWhere
     *
     * @param $key
     * @return bool
     */
    public function ModificarOperadorClausulasWhere($key): bool
    {
        $this->ClausulasWhere[$key][1] = $this->Operador;
        return true;
    }

    /**
     * @return bool
     */
    public function InicializarWhere($value = ''): bool
    {
        $this->ClausulasWhere = array(
            'Averiguacion' => ['Averiguacion', 'like', '%' . $value . '%'],
            'ID_Detenido' => ['Detenido', '>=', $value],
            'ID_Agencia' => ['ID_Agencia', '>=', $value],
            'Estatus' => ['Estatus', '=', $value],
            'Prueba' => ['Prueba', '=', $value],
        );

        return true;
    }

    /**
     * @return mixed
     */
    public function Consignacion(): mixed
    {
        $BusquedaConsignacion = $this->BusquedaConsignacion;
        $this->DefineBusqueda($BusquedaConsignacion);

        if ($this->Paginate) {
            return Consignacion::select('ID_Consignacion', 'ID_Agencia', 'Averiguacion', 'ID_Juzgado', 'Detenido')
                ->join('averiguacion_previa', 'consignacion.ID_Averiguacion', '=', 'averiguacion_previa.ID_Averiguacion')
                ->where($this->Busqueda)->paginate();
        } else {
            return Consignacion::select('ID_Consignacion', 'ID_Agencia', 'Averiguacion', 'ID_Juzgado', 'Detenido')
                ->join('averiguacion_previa', 'consignacion.ID_Averiguacion', '=', 'averiguacion_previa.ID_Averiguacion')
                ->where($this->Busqueda)->get();
        }
    }
}
