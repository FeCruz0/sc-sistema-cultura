<nav style="background:var(--brand);padding:12px 24px;color:#fff;">
  <div style="max-width:1100px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;">
    <div><strong>{{ config('app.name') }}</strong></div>

    <div>
      @auth
        <a href="{{ route('dashboard') }}" style="color:#fff;margin-right:12px">Painel</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button style="background:transparent;border:0;color:#fff;cursor:pointer">Sair</button></form>
      @else
        <a href="{{ route('login') }}" style="color:#fff">Entrar</a>
      @endauth
    </div>
  </div>
</nav>