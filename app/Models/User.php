<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'curriculo_aprovado', // <-- adicionado
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'curriculo_aprovado' => 'boolean',
    ];

    /**
     * Relacionamento com Agente Cultural
     */
    public function agenteCultural()
    {
        return $this->hasOne(AgenteCultural::class, 'user_id');
    }

    public function inscricoes()
    {
        return $this->hasMany(\App\Models\Inscricao::class);
    }

    // helper simples usado nas policies (opcional)
    public function hasRole(string $role): bool
    {
        return (string) $this->role === $role;
    }
}
