<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Calidad_Juridica;

class Calidad_Juridica_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Calidad_Juridica::query()->delete();
        for ($i=1; $i<11 ; $i++) { 
            Calidad_Juridica::create([
                'Calidad' => "Calidad Juridica $i"
            ]);
        }
    }
}
