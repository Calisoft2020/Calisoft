<?php
namespace App\Policies;

use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Proyecto;
use Illuminate\Auth\Access\HandlesAuthorization;


class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede crear proyecto
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'student' && !$user->proyectos()->wherePivot('tipo', 'integrante')->count();
    }

    /**
     * Determina si el usuario puede actualizar la informacion basica del proyecto.
     *
     * @param  \App\User  $user
     * @param  \App\Proyecto  $proyecto
     * @return mixed
     */
    public function update(User $user, Proyecto $proyecto)
    {
        return $user->proyectos()
            ->wherePivot('tipo', 'integrante')
            ->where('PK_id', $proyecto->PK_id)
            ->where('state', 'creacion')
            ->count() > 0;
    }

    /**
     * Determina si el usuario puede subir documentos
     * @param  \App\User  $user
     * @return boolean
     */
    public function upload(User $user)
    {
        return $user->proyectos()->where('state', 'activo')->count() > 0;
    }

    /**
     * Determina si el evaluador puede evaluar el proyecto
     * @param  \App\User  $user
     * @return boolean
     */
    public function evaluate(User $user, Proyecto $proyecto) {
        return $user->proyectos()->find($proyecto->PK_id) && $proyecto->state == 'evaluacion';
    }

    /**
     * Determina si el estudiante puede acceder a los resultados de evaluacion
     * @param User $user
     * @return boolean
     */
    public function see_evaluations(User $user) {
        $proyecto = $user->proyectos()->first();
        return $proyecto and ($proyecto->state == "evaluacion" || $proyecto->state == "completado");
    }

    public function see_global(User $user, Proyecto $proyecto) {
        return $proyecto->state == "completado";
    }
}
