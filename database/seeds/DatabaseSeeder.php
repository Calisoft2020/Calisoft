<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TiposDocumentoTableSeeder::class);
        $this->call(SemillerosTableSeeder::class);
        $this->call(GrupoInvestigacionTableSeeder::class);
        $this->call(ItemsCodificacionTableSeeder::class);
        $this->call(ModulosTableSeeder::class);
        $this->call(TipoNomenclaturaTableSeeder::class);
        $this->call(TipoBdTableSeeder::class);
        $this->call(ComponenteTableSeeder::class);
        $this->call(TipoInputsTestingSeeder::class);
        $this->call(TestValueSeeder::class);
    }
}
