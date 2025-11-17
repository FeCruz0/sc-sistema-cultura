@extends('layouts.app')

@section('title','Dashboard - ' . config('app.name'))

@push('styles')
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

        <a class="module" href="{{ route('agentes.index') }}" role="listitem">
            <div class="ico">👥</div>
            <div class="title">Agentes Culturais</div>
            <div class="desc">Cadastro e gerenciamento de agentes culturais.</div>
        </a>

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