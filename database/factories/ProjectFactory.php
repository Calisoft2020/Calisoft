<?php

use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\Categoria;
use App\Container\Calisoft\Src\Semillero;
use App\Container\Calisoft\Src\GrupoDeInvestigacion;





$factory->define(Proyecto::class, function (Faker\Generator $faker) {
    $categorias = Categoria::pluck('PK_id')->toArray();
    $semilleros = Semillero::pluck('PK_id')->toArray();
    $grupos = GrupoDeInvestigacion::pluck('PK_id')->toArray();

    return [
        'nombre' => $faker->catchPhrase(),
        'state' => 'propuesta',
        'FK_GrupoDeInvestigacionId' => $faker->randomElement($grupos),
        'FK_SemilleroId' => $faker->randomElement($semilleros),
        'FK_CategoriaId' => $faker->randomElement($categorias)
    ];
});
