<?php

use Illuminate\Database\Seeder;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_Modulos')->insert([
            [
                'nombre' => 'Plataforma'
            ],
            [
                'nombre' => 'Modelado'
            ],
            [
                'nombre' => 'Bases de Datos'
            ],
            [
                'nombre' => 'Codificación'
            ]
          ]);
    }
}
