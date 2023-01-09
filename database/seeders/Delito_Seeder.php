<?php

namespace Database\Seeders;

use App\Imports\DelitosImport;
use Illuminate\Database\Seeder;
use App\Models\Delito;
use Maatwebsite\Excel\Facades\Excel;

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
        //Ruta por defecto excel: storage/app
        Excel::import(new DelitosImport, 'Cat_Delitos.xlsx');
    }
}
