@extends('layouts.app')

@section('title', $agente->nome_completo . ' - ' . config('app.name'))

@section('content')
  <h1>{{ $agente->nome_completo }}</h1>
  <p><strong>Nome artístico:</strong> {{ $agente->nome_artistico }}</p>
  <p><strong>CPF / CNPJ:</strong> {{ agente->cpf_cnpj }}</p>
  <p><strong>Área de atuação></strong>{{ $agente->area_ataucao }}</p>
  <p><strong>Curriculo:</strong><br>{!! nl2br(e($agente->curriculo)) !!}</p>

  <a href="{{  route('agentes.edit', $agente) }}" class="btn">Editar</a>
  <a href="{{ route('agentes.index') }}" class="btn secondary">Voltar</a>
@endsection