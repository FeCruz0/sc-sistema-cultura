<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentosEtapas extends Model
{
    use HasFactory;

    protected $table = 'documentos_etapas';

    protected $fillable = [
        'id_etapa',
        'id_documento',
    ];

    /**
     * Relacionamento com Etapa
     */
    public function etapa()
    {
        return $this->belongsTo(Etapa::class, 'id_etapa');
    }

    /**
     * Relacionamento com Documento
     */
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}

