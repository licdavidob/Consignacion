<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona';

    public function getKeyName()
    {
        return "ID_Persona";
    }

    protected $fillable = [
        'Nombre',
        'Ap_Paterno',
        'Ap_Materno',
        'ID_Calidad',
        'ID_Consignacion',
    ];

    //Relación muchos a muchos
    public function Alias()
    {
        return $this->belongsToMany(Alias::class, 'alias_persona', 'ID_Persona', 'ID_Alias')->as('alias_persona');
    }

    //Catálogos
    public function Calidad()
    {
        return $this->belongsTo(Calidad_Juridica::class, 'ID_Calidad', 'ID_Calidad');
    }
}
