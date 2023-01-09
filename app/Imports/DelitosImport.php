<?php

namespace App\Imports;

use App\Models\Delito;
use Maatwebsite\Excel\Concerns\ToModel;

class DelitosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Delito::create([
            'Nombre' => $row[0]
        ]);
    }
}
