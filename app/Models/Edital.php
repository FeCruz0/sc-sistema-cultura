<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edital extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'processo',
        'situacao',
    ];

    protected $casts = [
        'situacao' => TiposSituacao::class,
    ];

    /**
     * Relacionamento com Inscrições
     */
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'id_edital');
    }

    /**
     * Relacionamento com Etapas
     */
    public function etapas()
    {
        return $this->hasMany(Etapa::class, 'id_edital');
    }

    /**
     * Relacionamento com Documentos do Edital
     */
    public function documentosEditais()
    {
        return $this->belongsToMany(Documento::class, 'documentos_editals', 'id_edital', 'id_documento');
    }

    /**
     * Relacionamento com Formulários
     */
    public function formularios()
    {
        return $this->hasMany(Formulario::class, 'id_edital');
    }
}

enum TiposSituacao: string
{
    case ABERTO = 'ABERTO';
    case ENCERRADO = 'ENCERRADO';
    case ARQUIVADO = 'ARQUIVADO';
}
