<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricaos';

    protected $fillable = [
        'id_agente',
        'id_edital',
    ];

    /**
     * Relacionamento com Agente Cultural
     */
    public function agenteCultural()
    {
        return $this->belongsTo(AgenteCultural::class, 'id_agente');
    }

    /**
     * Relacionamento com Edital
     */
    public function edital()
    {
        return $this->belongsTo(Edital::class, 'id_edital');
    }

    /**
     * Relacionamento com Documentos da Inscrição
     */
    public function documentosInscricao()
    {
        return $this->belongsToMany(Documento::class, 'documentos_inscricaos', 'id_inscricao', 'id_documento');
    }
}
