@extends('layouts.app')

@section('title','Login - ' . config('app.name'))

@push('styles')
<style>
:root{
  --bg-900:#071022;
  --bg-800:#0b1730;
  --panel:#071633;
  --glass: rgba(255,255,255,0.03);
  --accent-1:#4d7db9;
  --accent-2:#2f3a8f;
  --muted:#9fb0d8;
  --text:#e6eef8;
}

html,body{height:100%;margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial;background:linear-gradient(180deg,var(--bg-900),var(--bg-800));color:var(--text);-webkit-font-smoothing:antialiased;}

.login-wrap{display:flex;align-items:center;justify-content:center;min-height:100vh;padding:32px}

.login-card{
  width:100%;
  max-width:1100px;
  display:grid;
  grid-template-columns:1fr 420px;
  gap:0;
  border-radius:12px;
  overflow:hidden;
  border:1px solid rgba(255,255,255,0.04);
  background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
  box-shadow:0 20px 60px rgba(2,6,23,0.7);
}

/* painel informativo à esquerda */
.left{
  padding:48px;
  background:
    linear-gradient(135deg, rgba(77,125,185,0.10), rgba(47,58,143,0.06));
  display:flex;
  flex-direction:column;
  justify-content:center;
  gap:18px;
  color:var(--text);
  min-height:380px;
}
.brand{display:flex;align-items:center;gap:14px}
.brand .logo{
  width:64px;height:64px;border-radius:12px;
  background:linear-gradient(135deg,var(--accent-1),var(--accent-2));
  display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:20px;
  box-shadow:0 8px 30px rgba(47,58,143,0.28);
}
.left h2{margin:0;font-size:1.6rem}
.lead{color:var(--muted);max-width:520px;line-height:1.45}

/* estatísticas pequenas */
.left-stats{margin-top:12px;display:flex;gap:12px}
.stat{background:rgba(255,255,255,0.02);padding:10px 14px;border-radius:10px;font-weight:700;color:var(--text)}
.stat small{display:block;font-weight:500;color:var(--muted);font-size:0.82rem}

/* formulário à direita */
.right{padding:34px;background:linear-gradient(180deg, rgba(6,18,36,0.02), rgba(6,18,36,0.01));display:flex;align-items:center;justify-content:center}
.form-box{
  width:100%;
  max-width:360px;
  background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
  padding:28px;border-radius:12px;border:1px solid var(--glass);
  box-shadow:0 8px 30px rgba(2,6,23,0.5);
}
.form-box h3{margin:0 0 6px 0;color:var(--text)}
.form-box p{margin:0 0 14px 0;color:var(--muted)}

label{display:block;font-size:0.85rem;color:var(--muted);margin-bottom:8px}
input[type="email"],input[type="password"]{
  width:90%;
  padding:12px 14px;
  border-radius:10px;
  border:1px solid rgba(255,255,255,0.04);
  background:rgba(10,20,36,0.35);
  color:var(--text);
  outline:none;
  margin-bottom:12px;
  font-weight:600;
}
input::placeholder{color:#7f96bf;font-weight:500}

.actions{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:6px}
.remember{color:var(--muted);font-size:0.9rem;display:flex;align-items:center;gap:8px}
.btn{
  background:linear-gradient(90deg,var(--accent-1),var(--accent-2));
  color:white;padding:10px 18px;border-radius:999px;border:none;font-weight:800;cursor:pointer;
  box-shadow:0 10px 30px rgba(47,58,143,0.2);
}
.forgot{color:var(--muted);font-size:0.9rem;text-decoration:none}

.errors{background:rgba(255,50,50,0.06);border:1px solid rgba(255,50,50,0.12);padding:10px;border-radius:8px;color:#ffd6d6;margin-bottom:10px;font-weight:600}

@media (max-width:900px){
  .login-card{grid-template-columns:1fr;gap:0}
  .left{padding:28px}
  .right{padding:24px}
}
</style>
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