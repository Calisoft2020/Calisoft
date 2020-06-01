<?php
namespace App\Container\Calisoft\Src\Controllers;

use App\Container\Calisoft\Src\Notifications\ProyectoCreado;
use App\Container\Calisoft\Src\Notifications\ProyectoDenegado;
use App\Container\Calisoft\Src\Notifications\ProyectoAsignado;
use App\Container\Calisoft\Src\Notifications\EvaluadorAsignado;
use App\Container\Calisoft\Src\Notifications\ProyectoAceptado;
use App\Container\Calisoft\Src\Notifications\ProyectoEvaluacion;
use App\Container\Calisoft\Src\Notifications\ProyectoCompletado;
use App\Container\Calisoft\Src\Notifications\ProyectoActivado;

use App\Container\Calisoft\Src\Requests\ProyectoStoreRequest;
use App\Container\Calisoft\Src\Requests\ProyectoUpdateRequest;
use App\Container\Calisoft\Src\Requests\ProyectoDenegadoRequest;

use App\Container\Calisoft\Src\Requests\ProyectoAsignarRequest;
use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Proyecto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student')->only('update', 'propuesta');
        $this->middleware('role:admin')->only('index', 'aceptar', 'asignar');
        $this->middleware('role:evaluator')->only('show', 'activar', 'completar');
        $this->middleware('role:admin,student')->only('destroy');

    }

    public function index()
    {
        return Proyecto::with('semillero', 'categoria', 'grupoDeInvestigacion', 'usuarios')
            ->where('state', '<>', 'creacion')
            ->get();
    }

    public function show(Proyecto $proyecto)
    {
        return $proyecto;
    }

    public function store(ProyectoStoreRequest $request)
    {
        $request->user()->proyectos()->create([
            'nombre' => $request->nombre,
            'FK_GrupoDeInvestigacionId' => $request->grupo,
            'FK_SemilleroId' => $request->semillero,
            'FK_CategoriaId' => $request->categoria,
        ], [
            'tipo' => 'integrante'
        ]);

        return redirect()->route('home');
    }

    public function update(ProyectoUpdateRequest $request, Proyecto $proyecto)
    {
        $proyecto->update($request->all());
    }

    public function destroy(Proyecto $proyecto, ProyectoDenegadoRequest $request)
    {   
        //Envía notificación a usuario de eliminación junto con las razones
        $usuarios = $proyecto->usuarios()->get();
        Notification::send($usuarios, new ProyectoDenegado($proyecto->nombre, $request->text));

        $proyecto->delete();
    }

    public function documentos(Proyecto $proyecto)
    {
        return $proyecto->documentos->load(['tipo' => function ($query) {
            $query->select('PK_id', 'nombre');
        }]);
    }

    public function plataforma(Proyecto $proyecto)
    {
        return $proyecto->casoPruebas()->with('pruebas')->get();
    }


    /**
     * Cambia el estado del proyecto como propuesta
     * @param Proyecto $proyecto
     * @return Response
     */
    public function propuesta(Proyecto $proyecto)
    {

        $proyecto->usuarios()->wherePivot('tipo', 'invitado')->delete();
        $proyecto->state = 'propuesta';
        $proyecto->save();

        // Envío de noticifación a admin BEGIN
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new ProyectoCreado($proyecto));

        return $proyecto;
    }

    public function evaluacion(Proyecto $proyecto)
    {
        $proyecto->state = 'evaluacion';
        $proyecto->save();
        
        // Notificacion a Evaluadores
        $evaluadores = $proyecto->usuarios()->wherePivot('tipo', 'evaluador')->get();
        Notification::send($evaluadores, new ProyectoEvaluacion($proyecto->nombre));
        
        
        return $proyecto;
    }

    /**
     * Aceptar proyecto
     */
    public function aceptar(Proyecto $proyecto)
    {
        $proyecto->state = 'activo';
        $proyecto->save();
        //Envío de notificación hacia los integrantes del proyecto
        $integrantes = $proyecto->usuarios()->wherePivot('tipo', 'integrante')->get();
        Notification::send($integrantes, new ProyectoAceptado($proyecto));
        return $proyecto;
    }

    /**
     * Asignacion de evaluador
     */
    public function asignar(ProyectoAsignarRequest $request, Proyecto $proyecto)
    {

        $proyecto->usuarios()->syncWithoutDetaching([$request->user_id => [
            'tipo' => 'evaluador'
        ]]);
        //Notificación a evaluador
        $user = User::findOrFail($request->user_id);
        $user->notify(new ProyectoAsignado($proyecto));

        //Notificacion a integrantes
        $usuarios = $proyecto->usuarios()->where('role', '=', 'student')->get();
        Notification::send($usuarios, new EvaluadorAsignado($user, $proyecto));



        return $proyecto->usuarios;
    }

    /**
     * Desasignacion de evaluador
     */
    public function desasignar(Request $request, Proyecto $proyecto)
    {
        $this->validate($request, [
            'user_id' => 'required|integer|exists:TBL_Usuarios,PK_id'
        ]);
        $proyecto->usuarios()->detach($request->user_id);
        return $proyecto->usuarios;
    }


    public function scripts(Proyecto $proyecto)
    {
        return $proyecto->scripts;
    }

    public function basedatos(Proyecto $proyecto)
    {
        return $proyecto->sql()->with('tipobd')->get();
    }

    /**
     * Activa el proyecto para que el estudiante pueda actualizar documentos
     */
    public function activar(Proyecto $proyecto) {
        $update = ['state' => 'activo'];
        $proyecto->update($update);
        //Notificacion a integrantes
        $usuarios = $proyecto->usuarios()->where('role', '=', 'student')->get();
        Notification::send($usuarios, new ProyectoActivado($proyecto));
        return $update;
    }

    /**
     * Concluye la evaluacion del proyecto
     */
    public function completar(Proyecto $proyecto) {    
        $update = ['state' => 'completado'];
        $proyecto->update($update);

        //Notificacion a integrantes
        $usuarios = $proyecto->usuarios()->where('role', '=', 'student')->get();
        Notification::send($usuarios, new ProyectoCompletado($proyecto));
        return $update;
    }
}
