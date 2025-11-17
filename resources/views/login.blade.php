@extends('layouts.app')

@section('title','Login - ' . config('app.name'))

@push('styles')
@endpush

@section('content')
<div class="login-wrap" aria-label="Login">
  <div class="login-card" role="main">
    <div class="left" aria-hidden="false">
      <div class="brand">
        <div class="logo">SC</div>
        <div>
          <h2>{{ config('app.name') }}</h2>
          <p class="lead">Painel administrativo para gestão de editais, agentes culturais e inscrições — área restrita.</p>
        </div>
      </div>

      <div class="left-stats" aria-hidden="true">
        <div class="stat">
          12 <small>Editais ativos</small>
        </div>
        <div class="stat">
          348 <small>Inscrições</small>
        </div>
      </div>
    </div>

    <div class="right">
      <div class="form-box" role="form" aria-label="Formulário de login">
        <h3>Entrar na sua conta</h3>
        <p>Use suas credenciais de servidor público</p>

        @if ($errors->any())
          <div class="errors" role="alert">
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="seu.email@exemplo.gov" required autofocus>

          <label for="password">Senha</label>
          <input id="password" type="password" name="password" placeholder="••••••••" required>

          <div class="actions" style="margin-top:8px">
            <label class="remember"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar</label>
            <a class="forgot" href="#">Esqueci minha senha</a>
          </div>

          <div style="margin-top:18px;display:flex;justify-content:flex-end;">
            <button type="submit" class="btn">Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection