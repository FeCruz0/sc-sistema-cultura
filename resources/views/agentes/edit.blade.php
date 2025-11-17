@extends('layouts.app')

@section('content')
  <h1>Editar Agente Cultural</h1>
  <form method="POST" action="{{ route('agentes.update', $agente) }}">
    @csrf
    @include('agentes._form')
  </form>
@endsection