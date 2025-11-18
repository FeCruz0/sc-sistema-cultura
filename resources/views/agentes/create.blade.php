@extends('layouts.app')

@section('title','Novo agente cultural - ' . config('app.name'))

@section('content')
<div class="agentes">
  <div class="header">
    <div>
      <h1 class="title">Novo Agente Cultural</h1>
      <div class="subtitle">Preencha os dados do agente</div>
    </div>

    <div class="actions">
      <a href="{{ route('agentes.index') }}" class="btn ghost">Voltar</a>
    </div>
  </div>

  @if($errors->any())
    <div class="alert errors">
      @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
    </div>
  @endif

  <div class="card">
    <form method="POST" action="{{ route('agentes.store') }}" class="agente-form">
      @csrf
      @include('agentes._form')
      <div class="form-actions">
        <button type="submit" class="btn">Salvar</button>
        <a href="{{ route('agentes.index') }}" class="btn ghost">Cancelar</a>
      </div>
    </form>
  </div>
</div>
@endsection
