<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Calisoft\Src\TiposDocumento;

class Componente extends Model
{
    protected $table = "TBL_ComponentesDocumento";
    protected $primaryKey = "PK_id";

    protected $fillable = ['nombre', 'required', 'descripcion', 'FK_TipoDocumentoId'];

    protected $casts = [
        'required' => 'boolean'
    ];

    public function documento()
    {
        return $this->belongsTo(TiposDocumento::class, 'FK_TipoDocumentoId', 'PK_id');
    }
}
