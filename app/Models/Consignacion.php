<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignacion extends Model
{
    use HasFactory;

    // Laravel por defecto, busca la tabla en minuscula y plural (en este caso buscaría consignacions), en caso de que
    // no aplique a tus tablas, puedes sobreescribir la propiedad table con el nombre verdadero de tu tabla
    protected $table = 'consignacion';

    public function getKeyName()
    {
        return "ID_Consignacion";
    }

    protected $fillable = [
        'Fecha',
        'ID_Agencia',
        'Fojas',
        'ID_Averiguacion',
        'Detenido',
        'ID_Juzgado',
        'ID_Reclusorio',
        'Hora_Recibo',
        'Hora_Entrega',
        'Hora_Salida',
        'Hora_Regreso',
        'Hora_Llegada',
        'Fecha_Entrega',
        'Nota',
        'ID_created_by',
        'ID_updated_by',
    ];

    protected $hidden = [
        'ID_Agencia',
        'ID_Juzgado',
        'ID_Reclusorio',
        'ID_Averiguacion',
        'created_at',
        'updated_at',
        'Detenido',
    ];

    //Catálogos
    public function Agencia()
    {
        return $this->belongsTo(Agencia::class, 'ID_Agencia', 'ID_Agencia');
    }

    public function Juzgado()
    {
        return $this->belongsTo(Juzgado::class, 'ID_Juzgado', 'ID_Juzgado');
    }

    public function Reclusorio()
    {
        return $this->belongsTo(Reclusorio::class, 'ID_Reclusorio', 'ID_Reclusorio');
    }

    //Averiguación Previa
    public function Averiguacion()
    {
        return $this->belongsTo(Averiguacion_Previa::class, 'ID_Averiguacion', 'ID_Averiguacion');
    }

    //Usuarios
    public function CreatebyUser()
    {
        return $this->belongsTo(User::class, 'id', 'ID_created_by');
    }

    public function UpdatebyUser()
    {
        return $this->belongsTo(User::class, 'id', 'ID_updated_by');
    }

    //Relación muchos a muchos
    public function Delito()
    {
        return $this->belongsToMany(Delito::class, 'consignacion_delito', 'ID_Consignacion', 'ID_Delito')->withPivot('ID_Consignacion_Delito');
    }
}
