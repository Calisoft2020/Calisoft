<?php

use Illuminate\Database\Seeder;

class TipoInputsTestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_Inputs_Types')->insert([
            [
                'nombre' => 'Nombre persona',
                'reglas' => 'required|min:6|alpha_spaces'
            ],
            [
                'nombre' => 'Email',
                'reglas' => 'required|email'
            ],
            [
                'nombre' => 'Password',
                'reglas' => 'required|min:6'
            ],
            [
                'nombre' => 'Tel',
                'reglas' => 'required|min:6'
            ],
            [
                'nombre' => 'Url',
                'reglas' => 'required|url'
            ],
            [
                'nombre' => 'Text',
                'reglas' => 'required|min:6'

            ]
        ]);
    }
}
