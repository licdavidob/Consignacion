<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclusorio extends Model
{
    use HasFactory;

    protected $table = 'reclusorio';

    protected $fillable = [
        'Nombre',
    ];
}
