<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;

    protected $table = 'antecedente';

    public function getKeyName()
    {
        return "ID_Antecendente";
    }

    protected $fillable = [
        'Fecha_Antecendente',
        'Detenido',
        'ID_Juzgado',
        'ID_Consignacion',
    ];

    protected $hidden = [
        'ID_Juzgado',
        'Detenido',
        'Fecha_Antecendente',
    ];

    //Catálogo
    public function Juzgado()
    {
        return $this->belongsTo(Juzgado::class, 'ID_Juzgado', 'ID_Juzgado');
    }
}
