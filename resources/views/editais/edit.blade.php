@extends('layouts.app')

@section('title', 'Editar Edital - ' . config('app.name'))

@section('content')
<div class="editais container">
  <div class="back-to-list" style="margin-bottom:12px">
    <a href="{{ route('editais.index') }}" class="btn ghost">← Voltar para Lista</a>
  </div>

  <div class="header" style="margin-bottom:12px">
    <h1 class="title">Editar Edital</h1>
    <div class="subtitle">Altere os dados e salve</div>
  </div>

  @if ($errors->any())
    <div class="alert errors">
      <strong>Erro ao salvar:</strong>
      <ul class="error-list">
        @foreach ($errors->all() as $error)
          <li>• {{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('error'))
    <div class="alert errors">{{ session('error') }}</div>
  @endif

  <div class="card">
    <form method="POST" action="{{ route('editais.update', $edital->id) }}" id="editalForm" class="form-container" novalidate>
      @csrf
      @method('PUT')

      <h3 style="color:var(--accent-2); margin-bottom:12px;">Dados do Edital</h3>

      <div class="form-group">
        <label for="titulo">Título *</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $edital->titulo) }}" required maxlength="255" placeholder="Título do edital">
      </div>

      <div class="form-group">
        <label for="descricao">Descrição *</label>
        <textarea name="descricao" id="descricao" class="form-control" required placeholder="Descrição">{{ old('descricao', $edital->descricao) }}</textarea>
      </div>

      <div class="form-row" style="display:grid;grid-template-columns:1fr 320px;gap:12px">
        <div class="form-group">
          <label for="processo">Processo *</label>
          <input type="text" name="processo" id="processo" class="form-control" value="{{ old('processo', $edital->processo) }}" required maxlength="100" placeholder="Número do processo">
        </div>

        <div class="form-group">
          <label for="situacao">Situação *</label>
          <select name="situacao" id="situacao" class="form-control" required>
            <option value="">Selecione a situação</option>
            <option value="ABERTO" {{ old('situacao', $edital->situacao->value) == 'ABERTO' ? 'selected' : '' }}>Aberto</option>
            <option value="ENCERRADO" {{ old('situacao', $edital->situacao->value) == 'ENCERRADO' ? 'selected' : '' }}>Encerrado</option>
            <option value="ARQUIVADO" {{ old('situacao', $edital->situacao->value) == 'ARQUIVADO' ? 'selected' : '' }}>Arquivado</option>
          </select>
        </div>
      </div>

      <hr style="margin:18px 0">

      <div class="formularios-section">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
          <h3 style="color: var(--accent-2); margin:0">Formulários</h3>
          <button type="button" id="addFormulario" class="btn">+ Adicionar Formulário</button>
        </div>

        <div id="formulariosContainer" aria-live="polite"></div>
      </div>

      <div class="form-actions" style="margin-top:18px;display:flex;gap:10px;justify-content:flex-end">
        <a href="{{ route('editais.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn">Atualizar Edital</button>
      </div>
    </form>
  </div>
</div>

<!-- Templates -->
<template id="tpl-formulario">
  <div class="formulario-item card" data-formulario-id="">
    <div class="formulario-header" style="display:flex;justify-content:space-between;align-items:center">
      <h4>Formulário</h4>
      <div>
        <button type="button" class="btn ghost btn-remove-form">Remover</button>
      </div>
    </div>

    <div class="perguntas-container" style="margin-top:12px"></div>

    <div style="margin-top:12px; display:flex;justify-content:flex-end">
      <button type="button" class="btn" data-action="add-pergunta">+ Adicionar Pergunta</button>
    </div>
  </div>
</template>

<template id="tpl-pergunta">
  <div class="pergunta-item card" data-pergunta-id="">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <h5>Pergunta</h5>
      <div>
        <button type="button" class="btn ghost btn-remove-pergunta">Remover</button>
      </div>
    </div>

    <div class="form-group" style="margin-top:8px">
      <label>Texto da Pergunta *</label>
      <textarea name="" class="form-control pergunta-texto" required></textarea>
    </div>

    <div class="form-row" style="display:grid;grid-template-columns:1fr 120px;gap:8px;align-items:end">
      <div class="form-group">
        <label>Tipo *</label>
        <select name="" class="form-control pergunta-tipo" required>
          <option value="">Selecione o tipo</option>
          <option value="texto">Texto Livre</option>
          <option value="multipla_escolha">Múltipla Escolha</option>
          <option value="unica_escolha">Escolha Única</option>
          <option value="verdadeiro_falso">Verdadeiro/Falso</option>
        </select>
      </div>

      <div class="form-group">
        <label>&nbsp;</label>
        <div style="display:flex;gap:8px;align-items:center">
          <input type="hidden" name="" value="0">
          <input type="checkbox" name="" class="pergunta-obrigatoria" value="1" id="">
          <label class="small">Obrigatória</label>
        </div>
      </div>
    </div>

    <div class="alternativas-section hidden" style="margin-top:10px">
      <h6>Alternativas</h6>
      <div class="alternativas-container" style="margin-top:8px"></div>
      <div style="margin-top:8px;display:flex;justify-content:flex-end">
        <button type="button" class="btn" data-action="add-alternativa">+ Alternativa</button>
      </div>
    </div>
  </div>
</template>

<template id="tpl-alternativa">
  <div class="alternativa-item" style="display:flex;gap:8px;align-items:center;margin-bottom:8px" data-alternativa-id="">
    <input type="text" name="" class="form-control alternativa-texto" placeholder="Digite a alternativa" required>
    <label style="display:flex;align-items:center;gap:6px">
      <input type="hidden" name="" value="0">
      <input type="checkbox" name="" class="alternativa-correta" value="1">
      <span class="small">Correta</span>
    </label>
    <button type="button" class="btn ghost btn-remove-alternativa">×</button>
  </div>
</template>
@endsection

@push('scripts')
<script>
(() => {
  const formulariosContainer = document.getElementById('formulariosContainer');
  const tplFormulario = document.getElementById('tpl-formulario');
  const tplPergunta = document.getElementById('tpl-pergunta');
  const tplAlternativa = document.getElementById('tpl-alternativa');

  const editalData = @json($edital);
  let formCounter = 0, perguntaCounter = 0, alternativaCounter = 0;

  const createFromTemplate = (tpl) => tpl.content.firstElementChild.cloneNode(true);

  const addFormulario = (data = null) => {
    const node = createFromTemplate(tplFormulario);
    const fid = formCounter++;
    node.dataset.formularioId = fid;
    node.querySelector('h4').textContent = `Formulário ${fid + 1}`;
    node.querySelector('.perguntas-container').dataset.formularioId = fid;
    formulariosContainer.appendChild(node);
    if (data && data.perguntas) data.perguntas.forEach(p => addPergunta(fid, p));
    else addPergunta(fid);
    updateFormularioNumbers();
  };

  const removeFormulario = (node) => { node.remove(); updateFormularioNumbers(); };

  const addPergunta = (formularioId, data = null) => {
    const container = formulariosContainer.querySelector(`[data-formulario-id="${formularioId}"] .perguntas-container`);
    if (!container) return;
    const node = createFromTemplate(tplPergunta);
    const pid = perguntaCounter++;
    node.dataset.perguntaId = pid;
    node.querySelector('h5').textContent = `Pergunta ${getPerguntaCount(formularioId) + 1}`;

    // set names
    node.querySelector('.pergunta-texto').name = `formularios[${formularioId}][perguntas][${pid}][texto]`;
    node.querySelector('.pergunta-tipo').name = `formularios[${formularioId}][perguntas][${pid}][tipo]`;
    node.querySelector('.pergunta-obrigatoria').id = `obrigatoria_${pid}`;
    node.querySelector('.pergunta-obrigatoria').name = `formularios[${formularioId}][perguntas][${pid}][obrigatoria]`;
    node.querySelector('input[type="hidden"]').name = `formularios[${formularioId}][perguntas][${pid}][obrigatoria]`;

    if (data) {
      node.querySelector('.pergunta-texto').value = data.texto || '';
      node.querySelector('.pergunta-tipo').value = data.tipo || '';
      if (data.obrigatoria) node.querySelector('.pergunta-obrigatoria').checked = true;
    }

    container.appendChild(node);

    if (data && data.alternativas) data.alternativas.forEach(a => addAlternativaWithData(node, formularioId, pid, a));
    updatePerguntaNumbers(formularioId);
    toggleAlternativas(node, node.querySelector('.pergunta-tipo').value);
  };

  const removePergunta = (node) => { const fid = node.closest('.formulario-item').dataset.formularioId; node.remove(); updatePerguntaNumbers(fid); };

  const addAlternativa = (perguntaNode) => {
    const pid = perguntaNode.dataset.perguntaId;
    const formulario = perguntaNode.closest('.formulario-item');
    const fid = formulario.dataset.formularioId;
    const container = perguntaNode.querySelector('.alternativas-container');
    const node = createFromTemplate(tplAlternativa);
    const aid = alternativaCounter++;
    node.dataset.alternativaId = aid;
    node.querySelector('.alternativa-texto').name = `formularios[${fid}][perguntas][${pid}][alternativas][${aid}][texto]`;
    node.querySelector('.alternativa-correta').name = `formularios[${fid}][perguntas][${pid}][alternativas][${aid}][correta]`;
    node.querySelector('input[type="hidden"]').name = `formularios[${fid}][perguntas][${pid}][alternativas][${aid}][correta]`;
    container.appendChild(node);
  };

  const addAlternativaWithData = (perguntaNode, fid, pid, data) => {
    const container = perguntaNode.querySelector('.alternativas-container');
    const node = createFromTemplate(tplAlternativa);
    const aid = alternativaCounter++;
    node.dataset.alternativaId = aid;
    node.querySelector('.alternativa-texto').name = `formularios[${fid}][perguntas][${pid}][alternativas][${aid}][texto]`;
    node.querySelector('.alternativa-texto').value = data.texto || '';
    node.querySelector('.alternativa-correta').name = `formularios[${fid}][perguntas][${pid}][alternativas][${aid}][correta]`;
    if (data.correta) node.querySelector('.alternativa-correta').checked = true;
    node.querySelector('input[type="hidden"]').name = `formularios[${fid}][perguntas][${pid}][alternativas][${aid}][correta]`;
    container.appendChild(node);
  };

  const removeAlternativa = (node) => node.remove();

  const toggleAlternativas = (perguntaNode, tipo) => {
    const sec = perguntaNode.querySelector('.alternativas-section');
    if (['multipla_escolha','unica_escolha','verdadeiro_falso'].includes(tipo)) {
      sec.classList.remove('hidden');
      if (tipo === 'verdadeiro_falso') {
        const container = sec.querySelector('.alternativas-container');
        container.innerHTML = '';
        const addTF = (text) => {
          const n = createFromTemplate(tplAlternativa);
          const aid = alternativaCounter++;
          n.dataset.alternativaId = aid;
          n.querySelector('.alternativa-texto').name = `formularios[${perguntaNode.closest('.formulario-item').dataset.formularioId}][perguntas][${perguntaNode.dataset.perguntaId}][alternativas][${aid}][texto]`;
          n.querySelector('.alternativa-texto').value = text;
          n.querySelector('.alternativa-texto').readOnly = true;
          n.querySelector('.alternativa-correta').name = `formularios[${perguntaNode.closest('.formulario-item').dataset.formularioId}][perguntas][${perguntaNode.dataset.perguntaId}][alternativas][${aid}][correta]`;
          container.appendChild(n);
        };
        addTF('Verdadeiro'); addTF('Falso');
      } else if (sec.querySelector('.alternativas-container').children.length === 0) {
        addAlternativa(perguntaNode);
        addAlternativa(perguntaNode);
      }
    } else {
      sec.classList.add('hidden');
    }
  };

  const getPerguntaCount = (formularioId) => {
    const c = formulariosContainer.querySelector(`[data-formulario-id="${formularioId}"] .perguntas-container`);
    return c ? c.children.length : 0;
  };

  const updateFormularioNumbers = () => {
    formulariosContainer.querySelectorAll('.formulario-item').forEach((it, idx) => it.querySelector('h4').textContent = `Formulário ${idx + 1}`);
  };

  const updatePerguntaNumbers = (formularioId) => {
    const perguntas = formulariosContainer.querySelectorAll(`[data-formulario-id="${formularioId}"] .pergunta-item`);
    perguntas.forEach((p, idx) => p.querySelector('h5').textContent = `Pergunta ${idx + 1}`);
  };

  // Delegated events
  document.addEventListener('click', (e) => {
    if (e.target.matches('#addFormulario')) { addFormulario(); return; }

    if (e.target.closest('.btn-remove-form')) {
      const node = e.target.closest('.formulario-item');
      if (confirm('Remover formulário?')) removeFormulario(node);
      return;
    }

    if (e.target.matches('[data-action="add-pergunta"]')) {
      const fid = e.target.closest('.formulario-item').dataset.formularioId;
      addPergunta(fid);
      return;
    }

    if (e.target.closest('.btn-remove-pergunta')) {
      const node = e.target.closest('.pergunta-item');
      if (confirm('Remover pergunta?')) removePergunta(node);
      return;
    }

    if (e.target.matches('[data-action="add-alternativa"]')) {
      const perguntaNode = e.target.closest('.pergunta-item');
      addAlternativa(perguntaNode);
      return;
    }

    if (e.target.closest('.btn-remove-alternativa')) {
      const node = e.target.closest('.alternativa-item');
      removeAlternativa(node);
      return;
    }
  });

  document.addEventListener('change', (e) => {
    if (e.target.classList.contains('pergunta-tipo')) {
      const perguntaNode = e.target.closest('.pergunta-item');
      toggleAlternativas(perguntaNode, e.target.value);
    }
  });

  // Validation on submit
  document.getElementById('editalForm').addEventListener('submit', (e) => {
    const formularios = formulariosContainer.querySelectorAll('.formulario-item');
    if (formularios.length === 0) { e.preventDefault(); alert('É necessário adicionar pelo menos um formulário.'); return; }
    let ok = true;
    formularios.forEach((f, fi) => {
      const perguntas = f.querySelectorAll('.pergunta-item');
      if (perguntas.length === 0) { ok = false; alert(`O formulário ${fi+1} deve ter pelo menos uma pergunta.`); }
    });
    if (!ok) e.preventDefault();
  });

  // init with existing data
  document.addEventListener('DOMContentLoaded', () => {
    if (editalData.formularios && editalData.formularios.length) {
      editalData.formularios.forEach(f => addFormulario(f));
    } else addFormulario();
  });
})();
</script>
@endpush