<?php

namespace App\Models;

/**
 * Classe compatibilidade para código legado que referenciava UsuarioSemecct.
 * Herda tudo de App\Models\User e garante compatibilidade com campo 'senha'.
 */
class UsuarioSemecct extends User
{
    /**
     * Retorna o hash de senha usado pelo Laravel Auth.
     * Suporta campo legacy 'senha' ou o campo padrão 'password'.
     */
    public function getAuthPassword()
    {
        return $this->senha ?? $this->password ?? null;
    }
}