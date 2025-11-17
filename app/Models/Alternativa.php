<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pergunta',
        'texto',
        'correta',
    ];

    /**
     * Relacionamento com Pergunta
     */
    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class, 'id_pergunta');
    }

    /**
     * Relacionamento com Respostas
     */
    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'id_alternativa');
    }
}

