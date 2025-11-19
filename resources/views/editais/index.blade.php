@extends('layouts.app')

@section('title', 'Gerenciar Editais - ' . config('app.name'))

@section('content')
<div class="editais container">
  <div class="header" style="margin-bottom:12px; display:flex;justify-content:space-between;align-items:flex-start;gap:12px">
    <div>
      <h1 class="title">Gerenciar Editais</h1>
      <div class="subtitle">Lista de editais cadastrados</div>
    </div>

    <div class="actions">
      <a href="{{ route('editais.create') }}" class="btn">Novo Edital</a>
      <a href="{{ route('dashboard') }}" class="btn ghost">Voltar</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert errors">{{ session('error') }}</div>
  @endif

  <div class="card" style="padding:14px;">
    <div class="actions-bar" style="display:flex;gap:12px;align-items:center;margin-bottom:16px">
      <input type="text" id="searchEditais" class="form-control" placeholder="Buscar editais por título, processo ou descrição...">
      <a href="{{ route('editais.create') }}" class="btn">Novo Edital</a>
    </div>

    @if($editais->count() > 0)
      <div id="editaisGrid" class="editais-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:16px">
        @foreach($editais as $edital)
          <div class="edital-card card" data-search="{{ strtolower($edital->titulo . ' ' . $edital->processo . ' ' . $edital->descricao) }}">
            <div class="edital-header" style="display:flex;justify-content:space-between;align-items:flex-start;gap:8px">
              <div>
                <h3 class="edital-titulo" style="margin:0">{{ $edital->titulo }}</h3>
                <p class="edital-processo small" style="margin:6px 0 0 0">Processo: {{ $edital->processo }}</p>
              </div>
              <span class="edital-situacao small" style="white-space:nowrap">{{ $edital->situacao->value }}</span>
            </div>

            <div class="edital-descricao small" style="margin-top:10px">
              {{ Str::limit($edital->descricao, 150) }}
            </div>

            <div class="edital-info small" style="display:flex;gap:12px;flex-wrap:wrap;margin-top:12px">
              <div class="info-item"><span>Formulários:</span> <strong>{{ $edital->formularios->count() }}</strong></div>
              <div class="info-item"><span>Perguntas:</span> <strong>{{ $edital->formularios->sum(fn($f) => $f->perguntas->count()) }}</strong></div>
              <div class="info-item"><span>Criado:</span> <strong>{{ $edital->created_at->format('d/m/Y') }}</strong></div>
            </div>

            <div class="edital-actions" style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px">
              <a href="{{ route('editais.show', $edital->id) }}" class="btn ghost btn-sm">Visualizar</a>
              <a href="{{ route('editais.edit', $edital->id) }}" class="btn btn-sm">Editar</a>
              <button type="button" class="btn ghost btn-sm btn-delete" data-id="{{ $edital->id }}" data-title="{{ addslashes($edital->titulo) }}">Excluir</button>
            </div>
          </div>
        @endforeach
      </div>

      <div style="margin-top:14px">
        {{ $editais->links() }}
      </div>
    @else
      <div class="no-editais" style="padding:18px;margin-top:8px">
        <h3>Nenhum edital encontrado</h3>
        <p>Crie seu primeiro edital clicando em "Novo Edital".</p>
      </div>
    @endif
  </div>
</div>

<form id="deleteForm" method="POST" style="display:none">
  @csrf
  @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchEditais');
  const grid = document.getElementById('editaisGrid');
  const deleteForm = document.getElementById('deleteForm');

  // live search (simple, fast)
  if (searchInput && grid) {
    searchInput.addEventListener('input', function () {
      const term = this.value.trim().toLowerCase();
      const cards = grid.querySelectorAll('.edital-card');
      cards.forEach(c => c.style.display = (term === '' || (c.dataset.search || '').includes(term)) ? '' : 'none');
    });
  }

  // delegated delete handler
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-delete');
    if (!btn) return;
    const id = btn.dataset.id;
    const title = btn.dataset.title || 'este edital';
    if (!id) return;

    if (confirm(`Tem certeza que deseja excluir o edital "${title}"?\nEsta ação é irreversível.`)) {
      deleteForm.action = `/editais/${id}`;
      deleteForm.submit();
    }
  });
});
</script>
@endpush