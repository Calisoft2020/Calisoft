<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Repositories\FakerRepository;
use App\Container\Calisoft\Src\CasoPrueba;
use DB;


class TestingController extends Controller
{  
    /**
     * @var FakerRepository $fakerRepo
     */
    protected $fakerRepo;

    function __construct(FakerRepository $fakerRepo) {
        $this->fakerRepo = $fakerRepo;
    }

    /**
     * Retorna los valores para realizar las pruebas
     */
    public function testing(Request $request){
        $data = $request->validate([
            'inputs.*' => 'required',
            'tipo' => 'in:valido,invalido,sql,xss'
        ]);
        $values = collect();
        $valido = 0;
        
        
            foreach ($data['inputs'] as $inputType) {
                $value = '';
                switch ($data['tipo']) {
                    case 'sql':
                        $value = $this->fakerRepo->getSqlValue();
                        $valido = 0;
                        break;
                    case 'xss':
                        $value = $this->fakerRepo->getXssValue();
                        $valido = 0;
                        break;
                    case 'valido':
                            $value = $this->fakerRepo->getValidValue($inputType); // Valor Correcto
                            $valido = 1;
                        break;
                    default:
                        $value = $this->fakerRepo->getInvalidValue($inputType); // Valor incorrecto
                        $valido = 0;
                        break;
                }
                $values->push($value);     
            }
            return response()->json(compact('values', 'valido'));
        }
        
                    
                
            


    /**
     * Guarda la prueba y actualiza el promedio del caso prueba
     */
    public function guardar(Request $request, CasoPrueba $caso) {
        $data = $request->validate([
            'contexto.*.nombre' => 'string|required',
            'contexto.*.entrada' => 'string|required',
            'contexto.*.estado' => 'boolean|required',
            'calificacion' => 'numeric|required' 
        ]);
        $prueba = $caso->pruebas()->create($data);
        $caso->update(['calificacion' => DB::raw("(
            SELECT round(avg(calificacion), 2) 
            FROM TBL_Pruebas 
            WHERE FK_CasoPruebaId = {$caso->PK_id}
        )")]);
        return $prueba;
    }

}
