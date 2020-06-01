<?php

use Illuminate\Database\Seeder;

class GrupoInvestigacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('TBL_GruposDeInvestigacion')->insert([
          [
              'nombre' => 'GESAF'
          ],
          [
              'nombre' => 'GISTFA'
          ],
          [
              'nombre' => 'SIAAF'
          ]
        ]);
    }
}
