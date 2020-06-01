<?php
namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Repositories\Users;
use App\Container\Calisoft\Src\Requests\UserIndexRequest;
use App\Container\Calisoft\Src\Requests\UserStoreRequest;
use App\Container\Calisoft\Src\Requests\UserSearchEvaluatorsRequest;
use App\Container\Calisoft\Src\Requests\UserSearchFreeStudentsRequest;
use App\Container\Calisoft\Src\Notifications\UsuarioCreado;

class UserController extends Controller
{
    private $users;

    public function __construct(Users $users)
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only('index', 'store', 'destroy');
        $this->middleware('role:student,evaluator')->only('porcentajes');
        $this->users = $users;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserIndexRequest $request)
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => bcrypt($request['password']),
        ]);
        $user->notify(new UsuarioCreado($request->password));
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
    }

    /**
     * Retorna el proyecto del usuario logeado
     */
    public function proyectos()
    {
        return request()->user()->proyectos()->with(
            'semillero',
            'categoria',
            'grupoDeInvestigacion',
            'usuarios'
        )->get();
    }

    /**
     *  Retorna los estudiantes que no tienen
     *  proyectos, filtra por nombre
     */
    public function searchFreeStudents()
    {
        return $this->users->searchFreeStudents();
    }

    public function searchEvaluators()
    {
        return $this->users->searchEvaluators();
    }

    public function invitaciones()
    {
        return request()->user()->proyectos()->wherePivot('tipo', 'invitado')->get();
    }

    public function porcentajes()
    {
        return view('calisoft.global.categoria-porcentaje');
    }

    public function porcentajesBD()
    {
        return view('calisoft.global.bd-porcentaje');
    }

    public function porcentajesCodificacion()
    {
        return view('calisoft.global.codificacion-porcentaje');
    }

    public function estandaresCodificacion(){
        return view('calisoft.global.estandar-codificacion');
    }
    public function estandaresBasedatos(){
        return view('calisoft.global.estandar-baseDatos');
    }

}
