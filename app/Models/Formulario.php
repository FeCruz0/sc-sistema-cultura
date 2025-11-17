<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formulario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edital',
    ];

    /**
     * Relacionamento com Edital
     */
    public function edital()
    {
        return $this->belongsTo(Edital::class, 'id_edital');
    }

    /**
     * Relacionamento com Perguntas
     */
    public function perguntas()
    {
        return $this->hasMany(Pergunta::class, 'id_formulario');
    }
}

