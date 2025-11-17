<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etapa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edital',
        'titulo',
    ];

    /**
     * Relacionamento com Edital
     */
    public function edital()
    {
        return $this->belongsTo(Edital::class, 'id_edital');
    }

    /**
     * Relacionamento com Documentos da Etapa
     */
    public function documentos()
    {
        return $this->belongsToMany(Documento::class, 'documentos_etapas', 'id_etapa', 'id_documento');
    }
}
