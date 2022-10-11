<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delito;

class Delito_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delito::query()->delete();
        for ($i=1; $i<11 ; $i++) { 
            Delito::create([
                'Nombre' => "Delito $i"
            ]);
        }
    }
}
