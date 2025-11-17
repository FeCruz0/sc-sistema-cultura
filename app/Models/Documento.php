<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'caminho',
    ];

    /**
     * Relacionamento com Agentes Culturais (Documentos Pessoais)
     */
    public function agentesCulturais()
    {
        return $this->belongsToMany(AgenteCultural::class, 'documentos_pessoais', 'id_documento', 'id_agente');
    }

    /**
     * Relacionamento com Inscrições
     */
    public function inscricoes()
    {
        return $this->belongsToMany(Inscricao::class, 'documentos_inscricaos', 'id_documento', 'id_inscricao');
    }

    /**
     * Relacionamento com Editais
     */
    public function editais()
    {
        return $this->belongsToMany(Edital::class, 'documentos_editals', 'id_documento', 'id_edital');
    }

    /**
     * Relacionamento com Etapas
     */
    public function etapas()
    {
        return $this->belongsToMany(Etapa::class, 'documentos_etapas', 'id_documento', 'id_etapa');
    }
}
