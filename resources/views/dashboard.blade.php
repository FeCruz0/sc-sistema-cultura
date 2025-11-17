@extends('layouts.app')

@section('title','Dashboard - ' . config('app.name'))

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
  --danger:#ff6b6b;
}

html,body{height:100%;margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial;background:linear-gradient(180deg,var(--bg-900),var(--bg-800));color:var(--text);-webkit-font-smoothing:antialiased;}

.wrap{max-width:1200px;margin:32px auto;padding:0 16px}

header.app-header{
  background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
  border:1px solid rgba(255,255,255,0.03);
  padding:18px 22px;border-radius:12px;display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:20px;box-shadow:0 6px 18px rgba(2,6,23,0.6);backdrop-filter:blur(6px);
}

.brand{display:flex;gap:12px;align-items:center}
.brand .logo{width:48px;height:48px;border-radius:8px;background:linear-gradient(135deg,var(--accent-1),var(--accent-2));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800}
.brand h1{margin:0;font-size:1.1rem}
.brand .sub{font-size:.85rem;color:var(--muted)}

.user-actions{display:flex;align-items:center;gap:12px}
.user-card{background:var(--panel);padding:8px 12px;border-radius:10px;border:1px solid rgba(255,255,255,0.03);display:flex;gap:10px;align-items:center}
.user-card .avatar{width:40px;height:40px;border-radius:8px;background:linear-gradient(135deg,var(--accent-2),var(--accent-1));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
.user-card .meta .name{color:var(--text);font-weight:600}
.user-card .meta .email{color:var(--muted);font-size:.8rem}

.grid{display:grid;grid-template-columns:1fr 320px;gap:20px}

.panel{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));border-radius:12px;padding:18px;border:1px solid rgba(74,134,255,0.06);box-shadow:0 10px 30px rgba(2,6,20,0.6);color:var(--text)}

.welcome h2{margin:0;font-size:1.5rem;color:var(--accent-1)}
.welcome p{color:var(--muted);margin-top:6px}

.kpis{display:flex;gap:12px;flex-wrap:wrap;margin-top:12px}
.kpi{min-width:140px;background:linear-gradient(180deg, rgba(30,111,255,0.03), rgba(74,134,255,0.01));padding:12px;border-radius:10px;border:1px solid rgba(74,134,255,0.04)}
.kpi .num{font-size:1.4rem;font-weight:700}
.kpi .label{font-size:.85rem;color:var(--muted)}

.modules{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;margin-top:18px}
.module{background:var(--glass);border-radius:10px;padding:16px;color:var(--text);text-decoration:none;border:1px solid rgba(255,255,255,0.03);display:flex;flex-direction:column;align-items:center;gap:8px;transition:transform .18s ease,box-shadow .18s ease}
.module:hover{transform:translateY(-6px);box-shadow:0 18px 40px rgba(3,10,30,0.6)}
.module.disabled{opacity:.55;pointer-events:none}
.module .ico{font-size:26px}
.module .title{font-weight:700;color:var(--accent-1)}
.module .desc{font-size:.9rem;color:var(--muted);line-height:1.3}

.sidebar .shortcuts{display:flex;flex-direction:column;gap:10px;margin-top:8px}
.shortcut{display:block;padding:10px 12px;border-radius:10px;text-decoration:none;color:var(--text);background:linear-gradient(90deg, rgba(30,111,255,0.03), rgba(74,134,255,0.02));border:1px solid rgba(74,134,255,0.04)}
.shortcut.secondary{background:transparent;border:1px dashed rgba(255,255,255,0.03);color:var(--muted)}

.actions{display:flex;gap:10px;justify-content:flex-end;margin-top:18px}
.btn{background:linear-gradient(90deg,var(--accent-1),var(--accent-2));border:0;color:white;padding:10px 14px;border-radius:8px;font-weight:700;cursor:pointer;box-shadow:0 8px 24px rgba(47,58,143,0.12)}
.btn.ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--text);font-weight:600}

footer.meta{margin-top:18px;color:var(--muted);font-size:.85rem;text-align:center}

@media(max-width:1000px){.grid{grid-template-columns:1fr}header.app-header{flex-direction:column;align-items:flex-start;gap:12px}.user-actions{width:100%;justify-content:space-between}}
@media(max-width:520px){.wrap{margin:16px auto} .modules{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="wrap">
  <header class="app-header">
    <div class="brand">
      <div class="logo">SC</div>
      <div>
        <h1>{{ config('app.name') }}</h1>
        <div class="sub">Painel de controle</div>
      </div>
    </div>

    <div class="user-actions">
      <div class="user-card">
        <div class="avatar">{{ strtoupper(substr($user->nome ?? 'U',0,1)) }}</div>
        <div class="meta">
          <div class="name">{{ $user->nome }}</div>
          <div class="email">{{ $user->email }}</div>
        </div>
      </div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn">Sair</button>
      </form>
    </div>
  </header>

  <main class="grid">
    <section class="panel">
      <div class="welcome">
        <h2>Bem-vindo, {{ $user->nome }}!</h2>
        <p>Resumo rápido das principais informações do sistema.</p>
      </div>

      <div class="kpis" aria-hidden="false">
        <div class="kpi">
          <div class="num">12</div>
          <div class="label">Projetos ativos</div>
        </div>
        <div class="kpi">
          <div class="num">34</div>
          <div class="label">Tarefas pendentes</div>
        </div>
        <div class="kpi">
          <div class="num">5</div>
          <div class="label">Notificações</div>
        </div>
      </div>

      <div class="modules" role="list">
        <a class="module" href="{{ route('editais.index') }}" role="listitem">
          <div class="ico">📋</div>
          <div class="title">Editais</div>
          <div class="desc">Gerencie editais, crie formulários e acompanhe processos seletivos.</div>
        </a>

        <div class="module disabled" role="listitem" aria-disabled="true">
          <div class="ico">👥</div>
          <div class="title">Agentes Culturais</div>
          <div class="desc">Cadastro e gerenciamento de agentes culturais. <br><small style="color:var(--danger)">Em desenvolvimento</small></div>
        </div>

        <div class="module disabled" role="listitem" aria-disabled="true">
          <div class="ico">📝</div>
          <div class="title">Inscrições</div>
          <div class="desc">Visualize e gerencie inscrições realizadas nos editais.</div>
        </div>

        <div class="module disabled" role="listitem" aria-disabled="true">
          <div class="ico">📄</div>
          <div class="title">Documentos</div>
          <div class="desc">Gerenciamento de documentos e anexos do sistema.</div>
        </div>
      </div>

      <div class="actions" style="margin-top:18px">
        <a href="" class="btn">Ver projetos</a>
        <a href="" class="btn ghost">Relatórios</a>
      </div>

      <footer class="meta">Última sincronização: <strong>há 2 horas</strong></footer>
    </section>

    <aside class="panel sidebar">
      <h3 style="margin:0 0 10px 0;color:var(--accent-1)">Atalhos</h3>
      <div class="shortcuts">
        <a class="shortcut" href="">➕ Novo projeto</a>
        <a class="shortcut secondary" href="">⚙️ Configurações</a>
        <a class="shortcut secondary" href="">👥 Usuários</a>
      </div>

      <div style="height:12px"></div>

      <div style="border-top:1px solid rgba(255,255,255,0.03);padding-top:12px;margin-top:12px">
        <h4 style="margin:0 0 8px 0;color:var(--muted)">Atividades recentes</h4>
        <ul style="list-style:none;padding:0;margin:0;font-size:.9rem;color:var(--muted)">
          <li style="padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.02)">Atualização: Projeto Cultura SC — 2 horas</li>
          <li style="padding:8px 0">Mensagem de Felipe — 1 dia</li>
        </ul>
      </div>
    </aside>
  </main>
</div>
@endsection