<?php

use Illuminate\Database\Seeder;

class TipoNomenclaturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_TipoNomenclatura')->insert([
          [
            'nombre' => 'Base de Datos',
            'estandar' => 'BDS_',
            'nomenclatura' => 'BDS_',
            'valor' => '3',
          ],
          [
            'nombre' => 'Esquemas',
            'estandar' => 'SCH_',
            'nomenclatura' => 'SCH_',
            'valor' => '4',
          ],
          [
            'nombre' => 'Tablas',
            'estandar' => 'TBL_',
            'nomenclatura' => 'CREATE TABLE `TBL_',
            'valor' => '4',
          ],
          [
            'nombre' => 'Vistas',
            'estandar' => 'VWS_',
            'nomenclatura' => 'VWS_',
            'valor' => '4',
          ],
          [
            'nombre' => 'Llaves Primarias',
            'estandar' => 'PK_',
            'nomenclatura' => 'PRIMARY KEY (`PK_',
            'valor' => '5',
          ],
          [
            'nombre' => 'Llaves Foraneas',
            'estandar' => 'FK_',
            'nomenclatura' => 'FOREIGN KEY (`FK_',
            'valor' => '5',
          ],
          [
            'nombre' => 'Campo Descripcion',
            'estandar' => 'PGS_',
            'nomenclatura' => 'PGS_',
            'valor' => '3',
          ],
          [
            'nombre' => 'Campo ValorMoneda',
            'estandar' => 'CTB_',
            'nomenclatura' => 'CTB_',
            'valor' => '3',
          ],
          [
            'nombre' => 'Campo Observaciones',
            'estandar' => 'PSN_',
            'nomenclatura' => 'PSN_',
            'valor' => '3',
          ],
        ]);
    }
}
