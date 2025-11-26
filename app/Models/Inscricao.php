<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricaos';

    protected $fillable = [
        'edital_id',
        'user_id',
        'resposta',
        'status',
    ];

    protected $casts = [
        'resposta' => 'array',
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
    public function edital(): BelongsTo
    {
        return $this->belongsTo(Edital::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com Documentos da Inscrição
     */
    public function documentosInscricao()
    {
        return $this->belongsToMany(Documento::class, 'documentos_inscricaos', 'id_inscricao', 'id_documento');
    }
}
