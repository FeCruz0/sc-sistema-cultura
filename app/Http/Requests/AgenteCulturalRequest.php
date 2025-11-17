<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgenteCulturalRequest extends FormRequest
{
  public function authorize()
  {
    return auth()->check();
  }

  public function rules(){
    $id = $this->route('agente') ? $this->route(agente)->id : null;

    return[
      'nome_completo'  => ['requires','string','max:255'],
      'nome_artistico' => ['nullable','string','max:255'],
      'cpf_cnpj'       => ['nullable','string','max:30', Rule::unique('agente_culturals','cpf_cnpj')=>ignore($id)],
      'area_atuacao'   => ['nullable','string','max:255'],
      'curriculo'      => ['nullable','string'],  
    ];
  }

}