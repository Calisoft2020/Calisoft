<?php

use Illuminate\Database\Seeder;

class ItemsCodificacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_ItemsCodificacion')->insert([
            [
                'item' => 'Variables',
                'valor' => 5,
            ],
            [
                'item' => 'Clases',
                'valor' => 5,
            ],
            [
                'item' => 'Funciones',
                'valor' => 5,
            ],
            [
                'item' => 'Constantes',
                'valor' => 2,
            ],
            [
                'item' => 'Identacion',
                'valor' => 3,
            ],
            [
                'item' => 'Comentarios',
                'valor' => 3,
            ],
            [
                'item' => 'Espacios De Nombre',
                'valor' => 2,
            ],
        ]);
    }
}
