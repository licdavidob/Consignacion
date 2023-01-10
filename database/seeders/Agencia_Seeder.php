<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agencia;
use App\Imports\AgenciaImport;
use Maatwebsite\Excel\Facades\Excel;

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
        Excel::import(new AgenciaImport, 'Cat_Agencia.xlsx');
    }
}
