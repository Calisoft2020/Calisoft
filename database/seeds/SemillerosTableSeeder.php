<?php

use Illuminate\Database\Seeder;

class SemillerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('TBL_Semilleros')->insert([
          [
              'nombre' => 'Linudec'
          ],
          [
              'nombre' => 'Aplicaciones Moviles'
          ],
          [
              'nombre' => 'Programacion Web'
          ]
        ]);
    }
}
