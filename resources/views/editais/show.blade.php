@extends('layouts.app')

@section('title', $edital->titulo . ' - ' . config('app.name'))

@section('content')
<div class="editais container">
  <div class="back-to-list" style="margin-bottom:12px">
    <a href="{{ route('editais.index') }}" class="btn ghost">← Voltar para Lista</a>
  </div>

  <div class="header" style="margin-bottom:12px">
    <h1 class="title">{{ $edital->titulo }}</h1>
    <div class="subtitle">{{ Str::limit($edital->descricao, 120) }}</div>
  </div>

  <div class="card">
    <div class="edital-info" style="margin-bottom:16px;">
      <div class="info-row" style="display:flex;justify-content:space-between;gap:12px;align-items:center">
        <div>
          <div class="small">Processo</div>
          <div><strong>{{ $edital->processo }}</strong></div>
        </div>

        <div>
          <div class="small">Situação</div>
          <div>
            <span class="situacao-badge situacao-{{ strtolower($edital->situacao->value) }}" style="padding:6px 12px;border-radius:999px">
              {{ $edital->situacao->value }}
            </span>
          </div>
        </div>

        <div>
          <div class="small">Criado em</div>
          <div>{{ optional($edital->created_at)->format('d/m/Y H:i') ?? '—' }}</div>
        </div>
      </div>
    </div>

    <div class="descricao-section" style="margin-bottom:16px">
      <h3 class="section-title">Descrição</h3>
      <div class="descricao-text" style="margin-top:8px">
        {!! nl2br(e($edital->descricao)) !!}
      </div>
    </div>

    <div class="formularios-section" style="margin-bottom:8px">
      <h3 class="section-title">Formulários ({{ $edital->formularios->count() }})</h3>

      @forelse($edital->formularios as $i => $formulario)
        <div class="formulario-item card" style="margin-top:12px;">
          <div class="formulario-header" style="display:flex;justify-content:space-between;align-items:center">
            <div>Formulário {{ $i + 1 }}</div>
            <div class="small">{{ $formulario->perguntas->count() }} {{ $formulario->perguntas->count() === 1 ? 'pergunta' : 'perguntas' }}</div>
          </div>

          @foreach($formulario->perguntas as $j => $pergunta)
            <div class="pergunta-item" style="margin-top:10px">
              <div class="pergunta-header" style="display:flex;justify-content:space-between;align-items:center">
                <div class="pergunta-numero">Pergunta {{ $j + 1 }}</div>
                <div>
                  <span class="pergunta-tipo">{{ ucfirst(str_replace('_',' ',$pergunta->tipo)) }}</span>
                  @if($pergunta->obrigatoria)
                    <span class="pergunta-obrigatoria" style="margin-left:6px">Obrigatória</span>
                  @endif
                </div>
              </div>

              <div class="pergunta-texto" style="margin-top:8px">
                {{ $pergunta->texto }}
              </div>

              @if($pergunta->alternativas->count())
                <div class="alternativas-list" style="margin-top:8px">
                  <div class="alternativas-title">Alternativas ({{ $pergunta->alternativas->count() }})</div>
                  @foreach($pergunta->alternativas as $k => $alt)
                    <div class="alternativa-item" style="margin-top:8px">
                      <div class="alternativa-marker {{ $alt->correta ? 'alternativa-correta' : 'alternativa-incorreta' }}">
                        @if($alt->correta) ✓ @else {{ chr(65 + $k) }} @endif
                      </div>
                      <div class="alternativa-texto" style="margin-left:8px">{{ $alt->texto }}</div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          @endforeach
        </div>
      @empty
        <div style="padding:14px; color:var(--muted)">Nenhum formulário encontrado.</div>
      @endforelse
    </div>

    <div class="actions-bar" style="margin-top:14px;display:flex;justify-content:space-between;align-items:center">
      <div>
        <a href="{{ route('editais.edit', $edital->id) }}" class="btn">Editar</a>
      </div>

      <div style="display:flex;gap:10px">
        <a href="{{ route('editais.index') }}" class="btn ghost">Voltar</a>

        <form id="deleteForm" method="POST" action="{{ route('editais.destroy', $edital->id) }}" style="display:inline">
          @csrf
          @method('DELETE')
          <button type="button" class="btn action-delete" onclick="if(confirm('Excluir edital?')) document.getElementById('deleteForm').submit()">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection