<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Agencia_Seeder::class,
            Calidad_Juridica_Seeder::class,
            Delito_Seeder::class,
            Juzgado_Seeder::class,
            Reclusorio_Seeder::class,
        ]);
    }
}
