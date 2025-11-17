<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema Cultura</title>
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
            padding: 30px;
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

        .user-info {
            color: #6c757d;
            font-size: 1.1em;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .module-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .module-icon {
            font-size: 3em;
            text-align: center;
            margin-bottom: 20px;
        }

        .module-title {
            font-size: 1.4em;
            font-weight: 700;
            color: #04488c;
            margin-bottom: 10px;
            text-align: center;
        }

        .module-description {
            color: #6c757d;
            text-align: center;
            line-height: 1.5;
        }

        .actions-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
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

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .modules-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo, {{ $user->nome }}!</h1>
            <div class="user-info">{{ $user->email }}</div>
        </div>

        <div class="modules-grid">
            <a href="{{ route('editais.index') }}" class="module-card">
                <div class="module-icon">📋</div>
                <div class="module-title">Editais</div>
                <div class="module-description">
                    Gerencie editais, crie formulários com perguntas e alternativas para processos seletivos.
                </div>
            </a>

            <div class="module-card" style="opacity: 0.6;">
                <div class="module-icon">👥</div>
                <div class="module-title">Agentes Culturais</div>
                <div class="module-description">
                    Cadastro e gerenciamento de agentes culturais do município.
                    <br><small style="color: #dc3545;">Em desenvolvimento</small>
                </div>
            </div>

            <div class="module-card" style="opacity: 0.6;">
                <div class="module-icon">📝</div>
                <div class="module-title">Inscrições</div>
                <div class="module-description">
                    Visualize e gerencie inscrições realizadas nos editais publicados.
                    <br><small style="color: #dc3545;">Em desenvolvimento</small>
                </div>
            </div>

            <div class="module-card" style="opacity: 0.6;">
                <div class="module-icon">📄</div>
                <div class="module-title">Documentos</div>
                <div class="module-description">
                    Gerenciamento de documentos e anexos do sistema.
                    <br><small style="color: #dc3545;">Em desenvolvimento</small>
                </div>
            </div>
        </div>

        <div class="actions-bar">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary">Sair do Sistema</button>
            </form>
        </div>
    </div>
</body>
</html>