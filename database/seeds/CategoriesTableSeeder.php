<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_Categorias')->insert([
            [
                'nombre' => 'sistemas de información',
                'plataforma' => 25,
                'modelado'=> 25,
                'base_datos'=> 25,
                'codificacion'=> 25,
                'descripcion'=>'es cualquier sistema informático que se utilice para obtener, almacenar, manipular, administrar, controlar, procesar, transmitir o recibir datos, para satisfacer una necesidad de información'
            ],[
                'nombre' => 'sistemas de embebidos',
                'plataforma' => 25,
                'modelado'=> 25,
                'base_datos'=> 25,
                'codificacion'=> 25,
                'descripcion'=>' es un sistema de computación diseñado para realizar una o algunas pocas funciones dedicadas,​​ frecuentemente en un sistema de computación en tiempo real'
            ],
            [
                'nombre' => 'sistema artificial',
                'plataforma' => 25,
                'modelado'=> 25,
                'base_datos'=> 25,
                'codificacion'=> 25,
                'descripcion'=>'es un sistema físico o representativo, que interactua como variable dependiente de un sistema social.'
            ]
        ]);
    }
}
