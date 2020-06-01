<?php
namespace App\Container\Calisoft\Src\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\ArchivoSql;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Container\Calisoft\Src\Requests\DocumentosSqlStoreRequest;

class ArchivoSqlController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student', [
            'except' => ['index','preview'],
        ]);
    }

    public function index()
    {
        $proyecto = auth()->user()->proyectos()->first();
        return $proyecto->sql()->with('tipobd')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArchivoSql $sql)
    {
        Storage::disk('sql')->delete($sql->url);
        $sql->delete();
    }


    public function store(DocumentosSqlStoreRequest $request)
    {

        $file = $request->file('file');
        $proyecto = auth()->user()->proyectos()->first();
        $url = rand(1000, 9999) . '_' . $file->getClientOriginalName();
        $file->storeAs('/', $url, 'sql');
        return $proyecto->sql()->create([
            'url' => $url,
            'FK_TipoBdId' => $request->FK_TipoBdId,
        ]);
    }


    public function preview($url)
    {
        $disk = Storage::disk('sql');
        abort_unless($disk->exists($url), 404);
        $code = $disk->get($url);
        return response()->json(compact('code'));
    }

}
