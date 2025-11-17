@extends('layouts.app')

@section('title','Novo agente cultural - ' .config('app.name'))

@section('content')
  <h1>Novo Agente Cultural</h1>
  <form method="POST" action="{{  route('agentes.store') }}">
    @csrf
    @include('agentes._form')
  </form>
@endsection
