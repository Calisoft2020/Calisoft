<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Proyecto;

class FactoryProyectos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:proyectos {--cantidad=30 : Cantidad de proyectos a crear}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea proyectos falsos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cantidad = (int) $this->option('cantidad');
        factory(Proyecto::class, $cantidad)->create()->each(function ($p) {
            $usuario = factory(User::class)->make(['role' => 'student']);
            $p->usuarios()->save($usuario, ['tipo' => 'integrante']);
        });

        $this->info("$cantidad proyectos creados correctamente");
    }
}
