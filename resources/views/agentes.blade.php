@extends('layout.app')

@section('title', 'Agentes Culturais - ' . config('app.name'))

@section('content')
<h1>Agentes Culturais</h1>

<a href="{{  route('agentes.create') }}" class="btn">Novo Agente Cultural</a>

@if(session('success')) <div class="alert">{{  session('success') }}</div> @endif

<table class="table">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Nome Artístico</th>
      <th>Área de Atuação</th>
    </tr>
  </thead>
  <tbody>
    @foreach($agentes as $a)
    <tr>
      <td><a href="{{ route('agentes.show', $a) }}">{{ $a->nome_completo }}</a></td>
      <td>{{ $a->nome_artistico }}</td>
      <td>{{ $a->area_atuacao }}</td>
      <td>
        <a href="{{  route('agentes.edit', $a) }}">Editar</a>
        <form action="{{ route('agentes.destroy', $a) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button onclick="return confirm('Excluir agente?')">Excluir</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{  $agentes->links() }}
@endsection