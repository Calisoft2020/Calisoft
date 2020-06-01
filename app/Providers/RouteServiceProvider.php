<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapCalisoftRoutes();
        $this->mapAdminRoutes();
        $this->mapStudentRoutes();
        $this->mapEvaluatorRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('web')
             ->namespace('App\Container\Calisoft\Src\Controllers')
             ->group(base_path('routes/api.php'));
    }

    /**
     * Rutas de Administrador
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'role:admin'])
            ->namespace('App\Container\Calisoft\Src\Controllers')
            ->group(base_path('routes/admin.php'));
    }

    /*protected function mapCalisoftRoutes()
    {
        Route::middleware('web')
            ->namespace('App\Container\Calisoft\Src\Controllers')
            ->group(base_path('routes/calisoft.php'));
    }*/


    protected function mapStudentRoutes()
    {
        Route::middleware(['web', 'auth', 'role:student'])
            ->namespace('App\Container\Calisoft\Src\Controllers')
            ->group(base_path('routes/student.php'));
    }

    protected function mapEvaluatorRoutes()
    {
         Route::middleware(['web', 'auth', 'role:evaluator'])
            ->namespace('App\Container\Calisoft\Src\Controllers')
            ->group(base_path('routes/evaluator.php'));
    }

    protected function mapCalisoftRoutes(){
        Route::middleware('web')
             ->namespace('App\Container\Calisoft\Src\Controllers')
             ->group(base_path('routes/calisoft.php'));
    }

}
