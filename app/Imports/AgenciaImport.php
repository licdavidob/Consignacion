<?php

namespace App\Imports;

use App\Models\Agencia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgenciaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Agencia::create([
            'Nombre' => $row['nomenclatura'],
            'ID_Alcaldia' => $row['id_alcaldia'],
        ]);
    }
}
