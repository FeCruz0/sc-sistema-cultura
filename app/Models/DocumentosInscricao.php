<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentosInscricao extends Model
{
    use HasFactory;

    protected $table = 'documentos_inscricaos';

    protected $fillable = [
        'id_inscricao',
        'id_documento',
    ];

    /**
     * Relacionamento com Inscrição
     */
    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class, 'id_inscricao');
    }

    /**
     * Relacionamento com Documento
     */
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}

