<?php

namespace App\Imports;

use App\Models\Alcaldia;
use Maatwebsite\Excel\Concerns\ToModel;

class AlcaldiaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Alcaldia::create([
            'Alcaldia' => $row[0]
        ]);
    }
}
