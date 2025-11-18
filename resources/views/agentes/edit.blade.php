@extends('layouts.app')

@section('content')
  <div class="agentes">
    <div class="header">
      <div>
        <h1 class="title">Editar Agente Cultural</h1>
        <div class="subtitle">Atualize os dados e salve.</div>
      </div>

      <div class="actions">
        <a href="{{ route('agentes.index') }}" class="btn ghost">Voltar</a>
      </div>
    </div>

    <div class="card">
      <form method="POST" action="{{ route('agentes.update', $agente) }}" class="agente-form" novalidate aria-label="Formuário de edição de agente">
        @csrf
        @method('PUT')
        @include('agentes._form')
        <div class="form-actions">
          <button type="submit" class="btn">Salvar</button>
          <a href="{{ route('agentes.index') }}" class="btn ghost">Cancelar</a>
      </form>
    </div>
  </div>
@endsection