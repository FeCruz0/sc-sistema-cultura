<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Edital - Sistema Cultura</title>
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
            text-align: center;
        }

        .header h1 {
            color: #04488c;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #04488c;
            box-shadow: 0 0 0 3px rgba(4, 72, 140, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
        }

        .formularios-section {
            margin-top: 30px;
        }

        .formulario-item {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .formulario-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .pergunta-item {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
        }

        .pergunta-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .pergunta-controls {
            display: flex;
            gap: 10px;
        }

        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .col {
            flex: 1;
        }

        .col-auto {
            flex: 0 0 auto;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        .alternativas-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        .alternativa-item {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .alternativa-item input[type="text"] {
            flex: 1;
        }

        .alternativa-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            margin-top: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-list {
            list-style: none;
            margin: 0;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        .back-to-list {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .row {
                flex-direction: column;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 15px;
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
            <h1>Editar Edital</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erro ao salvar:</strong>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('editais.update', $edital->id) }}" id="editalForm">
            @csrf
            @method('PUT')

            <div class="form-container">
                <h3 style="color: #04488c; margin-bottom: 20px;">Dados do Edital</h3>
                
                <div class="form-group">
                    <label for="titulo">Título *</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" 
                           value="{{ old('titulo', $edital->titulo) }}" required maxlength="255">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição *</label>
                    <textarea name="descricao" id="descricao" class="form-control" 
                              required>{{ old('descricao', $edital->descricao) }}</textarea>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="processo">Processo *</label>
                            <input type="text" name="processo" id="processo" class="form-control" 
                                   value="{{ old('processo', $edital->processo) }}" required maxlength="100">
                        </div>
                    </div>
                    <div class="col">
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
                </div>
            </div>

            <div class="form-container">
                <div class="formularios-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: #04488c;">Formulários *</h3>
                        <button type="button" id="addFormulario" class="btn btn-success btn-sm">+ Adicionar Formulário</button>
                    </div>

                    <div id="formulariosContainer">
                        <!-- Formulários existentes serão carregados aqui -->
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('editais.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar Edital</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let formularioCounter = 0;
        let perguntaCounter = 0;
        let alternativaCounter = 0;
        
        // Dados existentes do edital
        const editalData = @json($edital);

        // Adicionar formulário
        document.getElementById('addFormulario').addEventListener('click', function() {
            addFormulario();
        });

        function addFormulario(formularioData = null) {
            const container = document.getElementById('formulariosContainer');
            const formularioId = formularioCounter++;
            
            const formularioHtml = `
                <div class="formulario-item" data-formulario-id="${formularioId}">
                    <div class="formulario-header">
                        <h4>Formulário ${formularioId + 1}</h4>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeFormulario(${formularioId})">Remover</button>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <h5>Perguntas</h5>
                        <button type="button" class="btn btn-success btn-sm" onclick="addPergunta(${formularioId})">+ Adicionar Pergunta</button>
                    </div>
                    
                    <div class="perguntas-container" data-formulario-id="${formularioId}">
                        <!-- Perguntas serão adicionadas aqui -->
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', formularioHtml);
            
            // Se tem dados do formulário, carregar as perguntas
            if (formularioData && formularioData.perguntas) {
                formularioData.perguntas.forEach(perguntaData => {
                    addPergunta(formularioId, perguntaData);
                });
            } else {
                addPergunta(formularioId); // Adicionar primeira pergunta automaticamente
            }
        }

        function removeFormulario(formularioId) {
            if (confirm('Tem certeza que deseja remover este formulário e todas as suas perguntas?')) {
                const formulario = document.querySelector(`[data-formulario-id="${formularioId}"]`);
                formulario.remove();
                updateFormularioNumbers();
            }
        }

        function addPergunta(formularioId, perguntaData = null) {
            const container = document.querySelector(`[data-formulario-id="${formularioId}"] .perguntas-container`);
            const perguntaId = perguntaCounter++;
            
            const perguntaHtml = `
                <div class="pergunta-item" data-pergunta-id="${perguntaId}">
                    <div class="pergunta-header">
                        <h6>Pergunta ${getPerguntaNumber(formularioId) + 1}</h6>
                        <div class="pergunta-controls">
                            <button type="button" class="btn btn-success btn-sm" onclick="addAlternativa(${perguntaId})">+ Alternativa</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removePergunta(${perguntaId})">Remover</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Texto da Pergunta *</label>
                        <textarea name="formularios[${formularioId}][perguntas][${perguntaId}][texto]" class="form-control" required>${perguntaData ? perguntaData.texto : ''}</textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tipo *</label>
                                <select name="formularios[${formularioId}][perguntas][${perguntaId}][tipo]" class="form-control" required onchange="toggleAlternativas(${perguntaId}, this.value)">
                                    <option value="">Selecione o tipo</option>
                                    <option value="texto" ${perguntaData && perguntaData.tipo === 'texto' ? 'selected' : ''}>Texto Livre</option>
                                    <option value="multipla_escolha" ${perguntaData && perguntaData.tipo === 'multipla_escolha' ? 'selected' : ''}>Múltipla Escolha</option>
                                    <option value="unica_escolha" ${perguntaData && perguntaData.tipo === 'unica_escolha' ? 'selected' : ''}>Escolha Única</option>
                                    <option value="verdadeiro_falso" ${perguntaData && perguntaData.tipo === 'verdadeiro_falso' ? 'selected' : ''}>Verdadeiro/Falso</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="checkbox-group">
                                    <input type="hidden" name="formularios[${formularioId}][perguntas][${perguntaId}][obrigatoria]" value="0">
                                    <input type="checkbox" name="formularios[${formularioId}][perguntas][${perguntaId}][obrigatoria]" value="1" id="obrigatoria_${perguntaId}" ${perguntaData && perguntaData.obrigatoria ? 'checked' : ''}>
                                    <label for="obrigatoria_${perguntaId}">Obrigatória</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alternativas-section ${perguntaData && (perguntaData.tipo === 'multipla_escolha' || perguntaData.tipo === 'unica_escolha' || perguntaData.tipo === 'verdadeiro_falso') ? '' : 'hidden'}" data-pergunta-id="${perguntaId}">
                        <h6>Alternativas</h6>
                        <div class="alternativas-container">
                            <!-- Alternativas serão adicionadas aqui -->
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', perguntaHtml);
            
            // Carregar alternativas se existirem
            if (perguntaData && perguntaData.alternativas && perguntaData.alternativas.length > 0) {
                perguntaData.alternativas.forEach(alternativaData => {
                    addAlternativaWithData(perguntaId, alternativaData);
                });
            }
            
            updatePerguntaNumbers(formularioId);
        }

        function removePergunta(perguntaId) {
            if (confirm('Tem certeza que deseja remover esta pergunta?')) {
                const pergunta = document.querySelector(`[data-pergunta-id="${perguntaId}"]`);
                const formularioContainer = pergunta.closest('.formulario-item');
                const formularioId = formularioContainer.dataset.formularioId;
                pergunta.remove();
                updatePerguntaNumbers(formularioId);
            }
        }

        function toggleAlternativas(perguntaId, tipo) {
            const alternativasSection = document.querySelector(`[data-pergunta-id="${perguntaId}"] .alternativas-section`);
            
            if (tipo === 'multipla_escolha' || tipo === 'unica_escolha' || tipo === 'verdadeiro_falso') {
                alternativasSection.classList.remove('hidden');
                
                if (tipo === 'verdadeiro_falso') {
                    // Limpar alternativas existentes e adicionar Verdadeiro/Falso
                    const container = alternativasSection.querySelector('.alternativas-container');
                    container.innerHTML = '';
                    addAlternativaVerdadeiroFalso(perguntaId, 'Verdadeiro', false);
                    addAlternativaVerdadeiroFalso(perguntaId, 'Falso', false);
                } else if (alternativasSection.querySelector('.alternativas-container').children.length === 0) {
                    // Adicionar duas alternativas padrão para múltipla escolha
                    addAlternativa(perguntaId);
                    addAlternativa(perguntaId);
                }
            } else {
                alternativasSection.classList.add('hidden');
            }
        }

        function addAlternativa(perguntaId) {
            const container = document.querySelector(`[data-pergunta-id="${perguntaId}"] .alternativas-container`);
            const alternativaId = alternativaCounter++;
            const formularioId = document.querySelector(`[data-pergunta-id="${perguntaId}"]`).closest('.formulario-item').dataset.formularioId;
            
            const alternativaHtml = `
                <div class="alternativa-item" data-alternativa-id="${alternativaId}">
                    <input type="text" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][texto]" 
                           class="form-control" placeholder="Digite a alternativa" required>
                    <div class="checkbox-group">
                        <input type="hidden" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][correta]" value="0">
                        <input type="checkbox" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][correta]" 
                               value="1" id="correta_${alternativaId}" title="Alternativa correta">
                        <label for="correta_${alternativaId}">Correta</label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeAlternativa(${alternativaId})">×</button>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', alternativaHtml);
        }

        function addAlternativaWithData(perguntaId, alternativaData) {
            const container = document.querySelector(`[data-pergunta-id="${perguntaId}"] .alternativas-container`);
            const alternativaId = alternativaCounter++;
            const formularioId = document.querySelector(`[data-pergunta-id="${perguntaId}"]`).closest('.formulario-item').dataset.formularioId;
            
            const alternativaHtml = `
                <div class="alternativa-item" data-alternativa-id="${alternativaId}">
                    <input type="text" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][texto]" 
                           class="form-control" value="${alternativaData.texto}" required>
                    <div class="checkbox-group">
                        <input type="hidden" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][correta]" value="0">
                        <input type="checkbox" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][correta]" 
                               value="1" id="correta_${alternativaId}" ${alternativaData.correta ? 'checked' : ''}>
                        <label for="correta_${alternativaId}">Correta</label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeAlternativa(${alternativaId})">×</button>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', alternativaHtml);
        }

        function addAlternativaVerdadeiroFalso(perguntaId, texto, correta) {
            const container = document.querySelector(`[data-pergunta-id="${perguntaId}"] .alternativas-container`);
            const alternativaId = alternativaCounter++;
            const formularioId = document.querySelector(`[data-pergunta-id="${perguntaId}"]`).closest('.formulario-item').dataset.formularioId;
            
            const alternativaHtml = `
                <div class="alternativa-item" data-alternativa-id="${alternativaId}">
                    <input type="text" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][texto]" 
                           class="form-control" value="${texto}" readonly>
                    <div class="checkbox-group">
                        <input type="hidden" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][correta]" value="0">
                        <input type="checkbox" name="formularios[${formularioId}][perguntas][${perguntaId}][alternativas][${alternativaId}][correta]" 
                               value="1" id="correta_${alternativaId}" ${correta ? 'checked' : ''}>
                        <label for="correta_${alternativaId}">Correta</label>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', alternativaHtml);
        }

        function removeAlternativa(alternativaId) {
            const alternativa = document.querySelector(`[data-alternativa-id="${alternativaId}"]`);
            alternativa.remove();
        }

        function getPerguntaNumber(formularioId) {
            const container = document.querySelector(`[data-formulario-id="${formularioId}"] .perguntas-container`);
            return container.children.length;
        }

        function updateFormularioNumbers() {
            const formularios = document.querySelectorAll('.formulario-item');
            formularios.forEach((formulario, index) => {
                const header = formulario.querySelector('.formulario-header h4');
                header.textContent = `Formulário ${index + 1}`;
            });
        }

        function updatePerguntaNumbers(formularioId) {
            const container = document.querySelector(`[data-formulario-id="${formularioId}"] .perguntas-container`);
            const perguntas = container.querySelectorAll('.pergunta-item');
            perguntas.forEach((pergunta, index) => {
                const header = pergunta.querySelector('.pergunta-header h6');
                header.textContent = `Pergunta ${index + 1}`;
            });
        }

        // Validação antes do envio
        document.getElementById('editalForm').addEventListener('submit', function(e) {
            const formularios = document.querySelectorAll('.formulario-item');
            
            if (formularios.length === 0) {
                e.preventDefault();
                alert('É necessário adicionar pelo menos um formulário.');
                return;
            }
            
            let hasError = false;
            formularios.forEach((formulario, formIndex) => {
                const perguntas = formulario.querySelectorAll('.pergunta-item');
                if (perguntas.length === 0) {
                    hasError = true;
                    alert(`O formulário ${formIndex + 1} deve ter pelo menos uma pergunta.`);
                }
            });
            
            if (hasError) {
                e.preventDefault();
            }
        });

        // Carregar dados existentes ao inicializar
        document.addEventListener('DOMContentLoaded', function() {
            if (editalData.formularios && editalData.formularios.length > 0) {
                editalData.formularios.forEach(formularioData => {
                    addFormulario(formularioData);
                });
            } else {
                addFormulario(); // Adicionar formulário vazio se não houver dados
            }
        });
    </script>
</body>
</html>
