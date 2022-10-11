<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reclusorio;

class Reclusorio_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reclusorio::query()->delete();
        for ($i=1; $i<11 ; $i++) { 
            Reclusorio::create([
                'Nombre' => "Reclusorio $i"
            ]);
        }
    }
}
