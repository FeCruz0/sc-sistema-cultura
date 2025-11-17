<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentosEdital extends Model
{
    use HasFactory;

    protected $table = 'documentos_editals';

    protected $fillable = [
        'id_edital',
        'id_documento',
    ];

    /**
     * Relacionamento com Edital
     */
    public function edital()
    {
        return $this->belongsTo(Edital::class, 'id_edital');
    }

    /**
     * Relacionamento com Documento
     */
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}

