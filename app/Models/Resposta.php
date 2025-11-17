<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resposta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pergunta',
        'id_alternativa',
        'id_inscricao',
        'texto',
    ];

    /**
     * Relacionamento com Pergunta
     */
    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class, 'id_pergunta');
    }

    /**
     * Relacionamento com Alternativa
     */
    public function alternativa()
    {
        return $this->belongsTo(Alternativa::class, 'id_alternativa');
    }

    /**
     * Relacionamento com Inscrição
     */
    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class, 'id_inscricao');
    }
}

