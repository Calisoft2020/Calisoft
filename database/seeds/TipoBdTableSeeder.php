<?php

use Illuminate\Database\Seeder;

class TipoBdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_TipoBd')->insert([
            [
                'nombre' => 'MySql',
            ],
            [
                'nombre' => 'PostgreSql'
            ],
        ]);
    }
}
