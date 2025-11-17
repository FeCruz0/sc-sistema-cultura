<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgenteCultural extends Model
{
    use HasFactory;

    protected $table = 'agente_culturals';

    protected $fillable = [
        'user_id',
        'nome_completo',
        'nome_artistico',
        'cpf_cnpj',
        'area_atuacao',
        'curriculo',
    ];

    /**
     * Relacionamento com User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento com Inscrições
     */
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'id_agente');
    }

    /**
     * Relacionamento com Documentos Pessoais
     */
    public function documentosPessoais()
    {
        return $this->belongsToMany(Documento::class, 'documentos_pessoais', 'id_agente', 'id_documento');
    }
}
