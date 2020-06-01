<?php
namespace App\Container\Calisoft\Src;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Container\Calisoft\Src\User;

class Proyecto extends Model
{
    use Notifiable;

    protected $table = "TBL_Proyectos";
    protected $primaryKey = "PK_id";

    protected $fillable = [
        'nombre', 'FK_GrupoDeInvestigacionId', 'FK_SemilleroId', 'FK_CategoriaId', 'state'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'FK_ProyectoId', 'PK_id');
    }

    public function casoPruebas()
    {
        return $this->hasMany(CasoPrueba::class, 'FK_ProyectoId', 'PK_id');
    }

    public function semillero()
    {
        return $this->belongsTo(Semillero::class, 'FK_SemilleroId')
            ->select('PK_id', 'nombre');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'FK_CategoriaId')
            ->select('PK_id', 'nombre');
    }

    public function grupoDeInvestigacion()
    {
        return $this->belongsTo(GrupoDeInvestigacion::class, 'FK_GrupoDeInvestigacionId')
            ->select('PK_id', 'nombre');
    }
    


    /*
     *  Relacion de proyecto con usuarios
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'TBL_ProyectosAsignados', 'FK_ProyectoId', 'FK_UsuarioId')
            ->withPivot('tipo')
            ->withTimestamps();
    }

    public function integrantes()
    {
        return $this->usuarios()->wherePivot('tipo', 'integrante');
    }

    public function evaluadores()
    {
        return $this->usuarios()->wherePivot('tipo', 'evaluador');
    }

    public function invitados()
    {
        return $this->usuarios()->wherePivot('tipo', 'invitado');
    }
    public function scripts()
    {
        return $this->hasMany(Script::class, 'FK_ProyectoId', 'PK_id');
    }

    public function sql()
    {
        return $this->hasOne(ArchivoSql::class, 'FK_ProyectoId', 'PK_id');
    }
}
