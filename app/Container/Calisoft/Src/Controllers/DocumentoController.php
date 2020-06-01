<?php
namespace App\Container\Calisoft\Src\Controllers;

use App\Container\Calisoft\Src\Documento;
use App\Container\Calisoft\Src\Requests\DocumentosIndexRequest;
use App\Container\Calisoft\Src\Requests\DocumentosStoreRequest;
use App\Container\Calisoft\Src\Requests\DocumentosUpdateRequest;
use App\Container\Calisoft\Src\TiposDocumento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student')->except('index', 'download', 'getfile');
        $this->middleware('can:upload,App\Proyecto')->only('store');
    }

    public function index(DocumentosIndexRequest $request)
    {
        $proyecto = auth()->user()->proyectos()->first();
        return $proyecto->documentos->load('tipo');
    }

    public function store(DocumentosStoreRequest $request)
    {
     
        $proyecto = $request->user()->proyectos()->first(); //obtiene el proyecto del usuario logeado
        $doc = new Documento(); //inicializa el documento a guardar
        $file = $request->file('file'); //obtiene el archivo
        $doc->nombre = $file->getClientOriginalName(); //nombre del archivp
        $doc->url = $file->store('/', 'documentos'); //guarda el archivo
        
        $doc->FK_TipoDocumentoId = $request->FK_TipoDocumentoId; //asigna el tipo
        $proyecto->documentos()->save($doc); //guarda y asigna el documento al proyecto
        return $doc;
    }

    public function update(DocumentosUpdateRequest $request, Documento $documentacion)
    {
        $documentacion->fill($request->all());
        $documentacion->save();
    }

    public function destroy(Documento $documentacion)
    {
        Storage::disk('documentos')->delete($documentacion->getOriginal('url'));
        $documentacion->delete();
    }

}
