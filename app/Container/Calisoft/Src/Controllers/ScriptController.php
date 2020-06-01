<?php
namespace App\Container\Calisoft\Src\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Script;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Container\Calisoft\Src\Requests\DocumentosScriptsStoreRequest;
use App\Container\Calisoft\Src\Requests\StudentSearchScriptsRequest;




class ScriptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student', [
            'except' => ['index','preview']
        ]);
        
    }
    public function index()
    {
        $proyecto = auth()->user()->proyectos()->first();
        return $proyecto->scripts;
    }

    /**
     * Elimina el script de la base de datos y
     * elimina el archivo
     *
     * @param Script $script
     * @return void
     */
    public function destroy(Script $script)
    {
        Storage::disk('scripts')->delete($script->url);
        $script->delete();
    }

    /**
     * Guarda y registra el script
     *
     * @param DocumentosScriptsStoreRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(DocumentosScriptsStoreRequest $request)
    {
        $file = $request->file('file');
        $proyecto = auth()->user()->proyectos()->first();
        $url = rand(1000, 9999) . '_' . $file->getClientOriginalName();
        $file->storeAs('/', $url, 'scripts');
        return $proyecto->scripts()->create(compact('url'));
    }


    public function preview($url)
    {
        $disk = Storage::disk('scripts');
        abort_unless($disk->exists($url), 404);
        $code = $disk->get($url);
        return response()->json(compact('code'));
    }



}
