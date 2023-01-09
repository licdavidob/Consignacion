<?php

namespace Database\Seeders;

use App\Imports\AlcaldiaImport;
use App\Models\Alcaldia;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class Alcaldia_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alcaldia::query()->delete();
        //Ruta por defecto excel: storage/app
        Excel::import(new AlcaldiaImport, 'Cat_Alcaldias.xlsx');
    }
}
