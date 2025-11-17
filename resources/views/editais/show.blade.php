<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $edital->titulo }} - Sistema Cultura</title>
    <link rel="icon" href="{{ asset('imagens/favicon.ico') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #04488c;
            font-size: 2.2em;
            margin-bottom: 10px;
            text-align: center;
        }

        .edital-info {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .info-row:last-child {
            margin-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
        }

        .info-value {
            color: #333;
            flex: 1;
            text-align: right;
        }

        .situacao-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .situacao-aberto {
            background: #d4edda;
            color: #155724;
        }

        .situacao-encerrado {
            background: #f8d7da;
            color: #721c24;
        }

        .situacao-arquivado {
            background: #d1ecf1;
            color: #0c5460;
        }

        .descricao-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .section-title {
            color: #04488c;
            font-size: 1.4em;
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9ecef;
        }

        .descricao-text {
            color: #495057;
            line-height: 1.6;
            font-size: 1em;
        }

        .formularios-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .formulario-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #04488c;
        }

        .formulario-item:last-child {
            margin-bottom: 0;
        }

        .formulario-header {
            font-size: 1.2em;
            font-weight: 600;
            color: #04488c;
            margin-bottom: 15px;
        }

        .pergunta-item {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .pergunta-item:last-child {
            margin-bottom: 0;
        }

        .pergunta-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .pergunta-numero {
            font-weight: 600;
            color: #04488c;
            font-size: 0.9em;
        }

        .pergunta-tipo {
            background: #e9ecef;
            color: #495057;
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 0.75em;
            font-weight: 500;
        }

        .pergunta-obrigatoria {
            background: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 0.75em;
            font-weight: 500;
            margin-left: 5px;
        }

        .pergunta-texto {
            color: #333;
            font-size: 1em;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .alternativas-list {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
        }

        .alternativas-title {
            font-weight: 600;
            color: #495057;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .alternativa-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            padding: 8px;
            background: white;
            border-radius: 4px;
        }

        .alternativa-item:last-child {
            margin-bottom: 0;
        }

        .alternativa-marker {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            font-weight: 600;
        }

        .alternativa-correta {
            background: #d4edda;
            color: #155724;
        }

        .alternativa-incorreta {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #dee2e6;
        }

        .alternativa-texto {
            flex: 1;
            color: #333;
        }

        .actions-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #04488c, #0056b3);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #04488c);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .back-to-list {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .stat-number {
            font-size: 1.8em;
            font-weight: 700;
            color: #04488c;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9em;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .actions-bar {
                flex-direction: column;
                gap: 15px;
            }
            
            .info-row {
                flex-direction: column;
            }
            
            .info-value {
                text-align: left;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="back-to-list">
        <a href="{{ route('editais.index') }}" class="btn btn-secondary">← Voltar para Lista</a>
    </div>

    <div class="container">
        <div class="header">
            <h1>{{ $edital->titulo }}</h1>
        </div>

        <!-- Informações do Edital -->
        <div class="edital-info">
            <div class="info-row">
                <div class="info-label">Processo:</div>
                <div class="info-value"><strong>{{ $edital->processo }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Situação:</div>
                <div class="info-value">
                    <span class="situacao-badge situacao-{{ strtolower($edital->situacao->value) }}">
                        {{ $edital->situacao->value }}
                    </span>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Criado em:</div>
                <div class="info-value">{{ $edital->created_at->format('d/m/Y \à\s H:i') }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Atualizado em:</div>
                <div class="info-value">{{ $edital->updated_at->format('d/m/Y \à\s H:i') }}</div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="edital-info">
            <h3 class="section-title">Estatísticas</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $edital->formularios->count() }}</div>
                    <div class="stat-label">{{ $edital->formularios->count() === 1 ? 'Formulário' : 'Formulários' }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $edital->formularios->sum(function($form) { return $form->perguntas->count(); }) }}</div>
                    <div class="stat-label">Total de Perguntas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $edital->formularios->sum(function($form) { return $form->perguntas->sum(function($pergunta) { return $pergunta->alternativas->count(); }); }) }}</div>
                    <div class="stat-label">Total de Alternativas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $edital->formularios->sum(function($form) { return $form->perguntas->where('obrigatoria', true)->count(); }) }}</div>
                    <div class="stat-label">Perguntas Obrigatórias</div>
                </div>
            </div>
        </div>

        <!-- Descrição -->
        <div class="descricao-section">
            <h3 class="section-title">Descrição</h3>
            <div class="descricao-text">
                {!! nl2br(e($edital->descricao)) !!}
            </div>
        </div>

        <!-- Formulários -->
        @if($edital->formularios->count() > 0)
            <div class="formularios-section">
                <h3 class="section-title">
                    Formulários ({{ $edital->formularios->count() }})
                </h3>

                @foreach($edital->formularios as $indexForm => $formulario)
                    <div class="formulario-item">
                        <div class="formulario-header">
                            Formulário {{ $indexForm + 1 }}
                            <span style="font-size: 0.8em; font-weight: normal; color: #6c757d;">
                                ({{ $formulario->perguntas->count() }} {{ $formulario->perguntas->count() === 1 ? 'pergunta' : 'perguntas' }})
                            </span>
                        </div>

                        @foreach($formulario->perguntas as $indexPerg => $pergunta)
                            <div class="pergunta-item">
                                <div class="pergunta-header">
                                    <span class="pergunta-numero">Pergunta {{ $indexPerg + 1 }}</span>
                                    <div>
                                        <span class="pergunta-tipo">{{ ucfirst(str_replace('_', ' ', $pergunta->tipo)) }}</span>
                                        @if($pergunta->obrigatoria)
                                            <span class="pergunta-obrigatoria">Obrigatória</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="pergunta-texto">
                                    {{ $pergunta->texto }}
                                </div>

                                @if($pergunta->alternativas->count() > 0)
                                    <div class="alternativas-list">
                                        <div class="alternativas-title">
                                            Alternativas ({{ $pergunta->alternativas->count() }})
                                        </div>
                                        
                                        @foreach($pergunta->alternativas as $indexAlt => $alternativa)
                                            <div class="alternativa-item">
                                                <div class="alternativa-marker {{ $alternativa->correta ? 'alternativa-correta' : 'alternativa-incorreta' }}">
                                                    @if($alternativa->correta)
                                                        ✓
                                                    @else
                                                        {{ chr(65 + $indexAlt) }}
                                                    @endif
                                                </div>
                                                <div class="alternativa-texto">{{ $alternativa->texto }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            <div class="formularios-section">
                <h3 class="section-title">Formulários</h3>
                <p style="text-align: center; color: #6c757d; padding: 20px;">
                    Nenhum formulário foi encontrado para este edital.
                </p>
            </div>
        @endif

        <!-- Ações -->
        <div class="actions-bar">
            <a href="{{ route('editais.index') }}" class="btn btn-secondary">← Voltar para Lista</a>
            
            <div style="display: flex; gap: 15px;">
                <a href="{{ route('editais.edit', $edital->id) }}" class="btn btn-primary">Editar</a>
                <button onclick="confirmDelete()" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div>

    <!-- Form para delete -->
    <form id="deleteForm" method="POST" action="{{ route('editais.destroy', $edital->id) }}" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete() {
            if (confirm('Tem certeza que deseja excluir este edital?\n\nEsta ação não pode ser desfeita e todos os formulários, perguntas e alternativas relacionados serão removidos.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</body>
</html>
