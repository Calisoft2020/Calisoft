<?php

namespace App\Container\Calisoft\Src\Repositories;

use App\Container\Calisoft\Src\User;

class Users
{
    public function searchFreeStudents()
    {
        return User::whereDoesntHave('proyectos', function ($query) {
            $query->where('tipo', '<>', 'invitado');
        })
        ->where('role', 'student')
        ->get();
    }

    public function searchEvaluators(){
        return User::withCount('proyectos')
            ->where('role', 'evaluator')
            ->get();
    }
}
