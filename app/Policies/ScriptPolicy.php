<?php

namespace App\Policies;

use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Script;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScriptPolicy
{
    use HandlesAuthorization;

    
    public function view(User $user, Script $script)
    {
        
        return $user->proyectos()->whereHas('scripts', function($query) use($script){
            $query->where('PK_id',$script->PK_id);
        } )->count()>0;
        
    }

    
}
