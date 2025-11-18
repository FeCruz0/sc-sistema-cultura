@extends('layouts.app')

@section('title', 'Agentes Culturais - ' . config('app.name'))

@section('content')
<div class="agentes">
  <div class="header">
    <div>
      <h1 class="title">Agentes Culturais</h1>
      <div class="subtitle">Lista de agentes cadastrados</div>
    </div>

    <div class="actions">
      <a href="{{ route('agentes.create') }}" class="btn">Novo Agente Cultural</a>
      <a href="{{ route('dashboard') }}" class="btn ghost">Voltar</a>
    </div>
  </div>

  @if(session('success')) <div class="alert">{{ session('success') }}</div> @endif

  <div class="card">
    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Nome Artístico</th>
          <th>Área de Atuação</th>
          <th style="width:180px;text-align:right">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($agentes as $a)
        <tr>
          <td><a class="link-inline" href="{{ route('agentes.show', $a) }}">{{ $a->nome_completo }}</a></td>
          <td>{{ $a->nome_artistico }}</td>
          <td>{{ $a->area_atuacao }}</td>
          <td class="col-actions">
            <a href="{{ route('agentes.edit', $a) }}" class="action-link">Editar</a>
            <a href="{{ route('agentes.show', $a) }}" class="action-link">Exibir</a>
            <form action="{{ route('agentes.destroy', $a) }}" method="POST" style="display:inline">
              @csrf @method('DELETE')
              <button class="action-delete" onclick="return confirm('Excluir agente?')">Excluir</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="empty">Nenhum agente encontrado.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $agentes->links() }}
</div>
@endsection