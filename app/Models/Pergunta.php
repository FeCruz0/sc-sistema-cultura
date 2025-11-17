<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pergunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_formulario',
        'texto',
        'tipo',
        'obrigatoria',
    ];

    /**
     * Relacionamento com Formulário
     */
    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'id_formulario');
    }

    /**
     * Relacionamento com Alternativas
     */
    public function alternativas()
    {
        return $this->hasMany(Alternativa::class, 'id_pergunta');
    }

    /**
     * Relacionamento com Respostas
     */
    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'id_pergunta');
    }
}

