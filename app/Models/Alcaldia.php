<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcaldia extends Model
{
    use HasFactory;

    protected $table = 'alcaldia';

    protected $fillable = [
        'Alcaldia',
    ];

    public function getKeyName(){
        return "ID_Alcaldia";
    }
}
