<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juzgado;

class Juzgado_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Juzgado::query()->delete();
        for ($i=1; $i<11 ; $i++) { 
            Juzgado::create([
                'Nombre' => "Juzgado $i"
            ]);
        }
    }
}
