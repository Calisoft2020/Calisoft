<?php
namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Documento;
use App\Container\Calisoft\Src\DocEvaluation;
use App\Container\Calisoft\Src\Repositories\Evaluations;

class DocumentEvalController extends Controller
{
    private $evaluations;

    function __construct(Evaluations $evaluations)
    {
        $this->evaluations = $evaluations;
    }

    /**
     * Extrae y sincroniza las evaluaciones segun 
     * componente y evaluador
     *
     * @param  Documento $documento
     * @return \Illuminate\Http\Response Evaluaciones del documento
     */
    public function show(Documento $documento)
    {
        return $this->evaluations->forDocument($documento, auth()->id());
    }



    /**
     * Actualiza la calificacion del componente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Documento $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        $this->validate($request, [
            'componente_id' => 'required|integer',
            'checked' => 'boolean',
            'observacion' => 'nullable|string'
        ]);
        
        
        
        $documento->evaluaciones()
            ->where('FK_EvaluatorId', auth()->id())
            ->where('FK_ComponenteId', $request->componente_id)
            ->where('FK_DocumentoId', $documento->PK_id)
            ->update($request->only('checked', 'observacion'));
        
        $cTot = DocEvaluation::all()->where('FK_DocumentoId', $documento->PK_id)->count();
        $docEva = DocEvaluation::all()->where('FK_DocumentoId', $documento->PK_id)->where('checked', '1')->count();
        $nota= $docEva/$cTot;
        $documento->nota= $nota;
        $documento->save();
        
    }


}
