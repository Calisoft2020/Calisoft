<?php

use Illuminate\Database\Seeder;

class TiposDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('TBL_TiposDocumento')->insert([
        [
        'nombre'=>'Diagrama de clases',
        'required'=> true,
      ],
      [
        'nombre'=>'Diagrama de casos de uso',
        'required'=>true,
      ],
      [
        'nombre'=>'Diagrama de secuencias',
        'required'=>true,
      ],
      [
        'nombre'=>'Diagrama de actividades',
        'required'=>true,
      ],
      [
        'nombre'=>'Diagrama de despliegue',
        'required'=>true,
      ],
      [
        'nombre'=>'Modelo Entidad Relación',
        'required'=>true,
      ],
      ]);
    }
}
