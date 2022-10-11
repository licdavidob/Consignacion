<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agencia;

class Agencia_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agencia::query()->delete();
        for ($i=1; $i<11 ; $i++) { 
            Agencia::create([
                'Nombre' => "Agencia $i"
            ]);
        }
    }
}
