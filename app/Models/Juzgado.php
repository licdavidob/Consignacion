<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juzgado extends Model
{
    use HasFactory;

    protected $table = 'juzgado';

    protected $fillable = [
        'Nombre',
    ];
}
