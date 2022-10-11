<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calidad_Juridica extends Model
{
    use HasFactory;

    protected $table = 'calidad_juridica';

    protected $fillable = [
        'Calidad',
    ];

    public function getKeyName()
    {
        return "ID_Calidad";
    }
}
