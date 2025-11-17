@extends('layouts.app')

@section('title', config('app.name'))

@push('styles')
@endpush

@section('content')
<header class="navbar" role="navigation" aria-label="Main Navigation">
  <div class="brand">
    <div class="logo">SC</div>
    <div>
      <div style="font-weight:800">{{ config('app.name') }}</div>
      <div style="font-size:0.85rem;color:var(--muted)">Cultura — editais e inscrições</div>
    </div>
  </div>

  <div class="menu" role="menu">
    <a href="{{ route('login') }}" class="btn-login" role="button">Entrar</a>
  </div>
</header>

<main class="container" role="main" aria-labelledby="home-title">
  <section class="hero" aria-labelledby="home-title">
    <div class="text">
      <h1 id="home-title">Editais abertos & programas culturais</h1>
      <p>Consulte os editais, prazos e inscrições. Área pública para visualização; a gestão é feita por servidores através do painel.</p>
    </div>
    <div class="callout" aria-hidden="true">
      <div style="background:linear-gradient(135deg,var(--accent-1),var(--accent-2));padding:18px;border-radius:10px;color:#fff;font-weight:700;box-shadow:0 10px 30px rgba(47,58,143,0.18);">Próximo prazo: 30/11/2025</div>
    </div>
  </section>

  <section aria-label="Editais" class="editais">
    <div class="cards-grid" id="editais-container" aria-live="polite">
      <!-- cards serão renderizados via JS -->
    </div>
  </section>
</main>

<!-- Modal -->
<div id="edital-modal" class="modal" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="modal-conteudo" role="document">
    <button class="modal-fechar" aria-label="Fechar" id="modal-fechar">&times;</button>
    <h2 id="modal-titulo"></h2>
    <p id="modal-descricao" style="color:var(--muted)"></p>
    <p style="margin-top:12px;color:var(--muted)"><strong>Status:</strong> <span id="modal-status"></span></p>
    <p style="margin-top:8px;"><a id="modal-link" class="botao-detalhes" href="#" target="_blank">Ver edital</a></p>
  </div>
</div>

@push('scripts')
<script>
const editais = [
  { id:1, titulo:"Edital de Artes Visuais", descricao_curta:"Apoio a exposições e instalações.", descricao_completa:"Detalhes do edital de artes visuais...", data_inicio:"2025-10-15", data_fim:"2025-11-30", status:"aberto", link_edital:"#", imagem_destaque:"{{ asset('imagens/download.jpg') }}" },
  { id:2, titulo:"Concurso de Poesia", descricao_curta:"Concurso nacional para novos poetas.", descricao_completa:"Detalhes do concurso de poesia...", data_inicio:"2025-09-20", data_fim:"2025-10-30", status:"encerrado", link_edital:"#", imagem_destaque:"{{ asset('imagens/download.jpg') }}" }
];

function formatarData(d){ const dt=new Date(d); return String(dt.getDate()).padStart(2,'0') + '/' + String(dt.getMonth()+1).padStart(2,'0') + '/' + dt.getFullYear(); }

function gerarCardHTML(edital){
  const img = edital.imagem_destaque ? `<img src="${edital.imagem_destaque}" alt="">` : '';
  return `<div class="card" data-id="${edital.id}">
    ${img}
    <div class="card-conteudo">
      <h3 class="card-titulo">${edital.titulo}</h3>
      <p class="card-descricao">${edital.descricao_curta}</p>
      <div class="card-data">De ${formatarData(edital.data_inicio)} a ${formatarData(edital.data_fim)}</div>
      <div class="card-acoes"><button class="botao-detalhes" data-id="${edital.id}">Ver detalhes</button></div>
    </div>
  </div>`;
}

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('editais-container');
  if(editais.length){ editais.forEach(e => container.innerHTML += gerarCardHTML(e)); }
  else container.innerHTML = '<p style="color:var(--muted)">Nenhum edital disponível.</p>';

  const modal = document.getElementById('edital-modal');
  const fechar = document.getElementById('modal-fechar');

  container.addEventListener('click', (ev) => {
    const btn = ev.target.closest('.botao-detalhes');
    if(!btn) return;
    const id = parseInt(btn.dataset.id,10);
    const edital = editais.find(x => x.id===id);
    if(!edital) return;
    document.getElementById('modal-titulo').textContent = edital.titulo;
    document.getElementById('modal-descricao').textContent = edital.descricao_completa;
    document.getElementById('modal-status').textContent = edital.status;
    document.getElementById('modal-link').href = edital.link_edital || '#';
    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden','false');
  });

  fechar.addEventListener('click', ()=>{ modal.style.display='none'; modal.setAttribute('aria-hidden','true'); });
  window.addEventListener('click',(e)=>{ if(e.target===modal){ modal.style.display='none'; modal.setAttribute('aria-hidden','true'); } });
});
</script>
@endpush

@endsection