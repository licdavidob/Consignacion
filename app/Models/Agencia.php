<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    use HasFactory;
    
    protected $table = 'agencia';

    protected $fillable = [
        'Nombre',
    ];

    public function getKeyName(){
        return "ID_Agencia";
    }

    public function Consignacion(){
        return $this->hasMany(Consignacion::class,'ID_Consignacion','ID_Consignacion');
    }
}
