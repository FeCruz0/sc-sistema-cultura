<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentosPessoais extends Model
{
    use HasFactory;

    protected $table = 'documentos_pessoais';

    protected $fillable = [
        'id_agente',
        'id_documento',
    ];

    /**
     * Relacionamento com Agente Cultural
     */
    public function agenteCultural()
    {
        return $this->belongsTo(AgenteCultural::class, 'id_agente');
    }

    /**
     * Relacionamento com Documento
     */
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}

