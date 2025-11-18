@extends('layouts.app')

@section('title', $agente->nome_completo . ' - ' . config('app.name'))

@section('content')
<div class="agentes">
  <div class="header">
    <div>
      <h1 class="title">{{ $agente->nome_completo }}</h1>
      @if($agente->nome_artistico)
        <div class="subtitle">{{ $agente->nome_artistico }}</div>
      @endif
    </div>

    <div class="actions">
      <a href="{{  route('agentes.index') }}" class="btn ghost">Voltar</a>
      <a href="{{ route('agentes.edit', $agente) }}" class="btm">Editar</a>
    </div>
  </div>

  <div class="card agente-card">
    <div class="agente-detail">
      <p><strong>CPF / CNPJ:</strong> {{ $agente->cpf_cnpj ?? '-' }}</p>
      <p><strong>Área de atuação:</strong> {{ $agente->area_atuacao ?? '-' }}</p>
      <p><strong>Curriculo:</strong><br> {!! nl2br(e($agente->curriculo)) !!}</p>
    </div>

    <aside class="agente-meta">
      <h3>Informações</h3>
      <p class="small">Criado em: {{ optional($agente->created_at)->format('d/m/Y H:i') ?? '-' }}</p>
      <p class="small">Última atualização: {{ optional($agente->updated_at)->diffForHumans() ?? '-' }}</p>

      <div style="margin-top:12px" class="col-actions">
        <a href="{{ route('agentes.edit', $agente) }}" class="action-link">Editar</a>

        <form adction="{{ route('agentes.destroy', $agente) }}" method="POST" style="display:inline">
          @csrf
          @method('DELETE')
          <button class="action-delete" onclick="return confirm('Excluir agente?')">Excluir</button>
        </form>
      </div>
    </aside>
  </div>
</div> 
@endsection