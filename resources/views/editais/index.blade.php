<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editais - Sistema Cultura</title>
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
            max-width: 1200px;
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
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 10px;
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
            box-shadow: 0 4px 12px rgba(4, 72, 140, 0.3);
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

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
        }

        .search-box {
            padding: 10px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            width: 300px;
        }

        .search-box:focus {
            outline: none;
            border-color: #04488c;
            box-shadow: 0 0 0 3px rgba(4, 72, 140, 0.1);
        }

        .editais-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .edital-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .edital-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .edital-header {
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .edital-titulo {
            color: #04488c;
            font-size: 1.3em;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .edital-processo {
            color: #6c757d;
            font-size: 0.9em;
            font-weight: 500;
        }

        .edital-situacao {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 600;
            margin-bottom: 10px;
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

        .edital-descricao {
            color: #495057;
            font-size: 0.95em;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .edital-info {
            font-size: 0.85em;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .edital-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
            flex: 1;
            min-width: 80px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .no-editais {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            color: #6c757d;
        }

        .no-editais h3 {
            margin-bottom: 15px;
            color: #495057;
        }

        .back-to-dashboard {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .editais-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-bar {
                flex-direction: column;
                gap: 15px;
            }
            
            .search-box {
                width: 100%;
            }
            
            .edital-actions {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="back-to-dashboard">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Dashboard</a>
    </div>

    <div class="container">
        <div class="header">
            <h1>Gerenciar Editais</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="actions-bar">
            <input type="text" id="searchEditais" class="search-box" placeholder="Buscar editais por título, processo ou descrição...">
            <a href="{{ route('editais.create') }}" class="btn btn-primary">+ Novo Edital</a>
        </div>

        @if($editais->count() > 0)
            <div class="editais-grid" id="editaisGrid">
                @foreach($editais as $edital)
                    <div class="edital-card" data-search="{{ strtolower($edital->titulo . ' ' . $edital->processo . ' ' . $edital->descricao) }}">
                        <div class="edital-header">
                            <h3 class="edital-titulo">{{ $edital->titulo }}</h3>
                            <p class="edital-processo">Processo: {{ $edital->processo }}</p>
                            <span class="edital-situacao situacao-{{ strtolower($edital->situacao->value) }}">
                                {{ $edital->situacao->value }}
                            </span>
                        </div>

                        <div class="edital-descricao">
                            {{ Str::limit($edital->descricao, 150) }}
                        </div>

                        <div class="edital-info">
                            <div class="info-item">
                                <span>Formulários:</span>
                                <strong>{{ $edital->formularios->count() }}</strong>
                            </div>
                            <div class="info-item">
                                <span>Total de Perguntas:</span>
                                <strong>{{ $edital->formularios->sum(function($form) { return $form->perguntas->count(); }) }}</strong>
                            </div>
                            <div class="info-item">
                                <span>Criado em:</span>
                                <strong>{{ $edital->created_at->format('d/m/Y H:i') }}</strong>
                            </div>
                        </div>

                        <div class="edital-actions">
                            <a href="{{ route('editais.show', $edital->id) }}" class="btn btn-secondary btn-sm">Visualizar</a>
                            <a href="{{ route('editais.edit', $edital->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <button onclick="confirmDelete({{ $edital->id }}, '{{ $edital->titulo }}')" class="btn btn-danger btn-sm">Excluir</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-editais">
                <h3>Nenhum edital encontrado</h3>
                <p>Comece criando seu primeiro edital clicando no botão "Novo Edital" acima.</p>
            </div>
        @endif
    </div>

    <!-- Form para delete -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Busca em tempo real
        document.getElementById('searchEditais').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.edital-card');
            
            cards.forEach(card => {
                const searchData = card.getAttribute('data-search');
                if (searchData.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Confirmação de exclusão
        function confirmDelete(id, titulo) {
            if (confirm(`Tem certeza que deseja excluir o edital "${titulo}"?\n\nEsta ação não pode ser desfeita e todos os formulários, perguntas e alternativas relacionados serão removidos.`)) {
                const form = document.getElementById('deleteForm');
                form.action = `/editais/${id}`;
                form.submit();
            }
        }
    </script>
</body>
</html>
