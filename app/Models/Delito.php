<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delito extends Model
{
    use HasFactory;

    protected $table = 'delito';

    public function getKeyName(){
        return "ID_Delito";
    }

    protected $fillable = [
        'Nombre',
    ];
}
