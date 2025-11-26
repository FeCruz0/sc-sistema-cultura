<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# SC — Sistema Cultura

Aplicação Laravel para gerenciar agentes culturais, editais e formulários. Interface responsiva com partials SCSS organizados e JavaScript leve para manipulação dinâmica de formulários.

## Requisitos
- PHP 8.2+ (8.4 recomendado)
- Composer
- Node.js 18+
- NPM
- Extensões PHP: pdo, pdo_sqlite, mbstring, xml, curl, zip, pcntl (conforme necessidade)

## Instalação (desenvolvimento)
1. Clonar o repositório
```bash
git clone <repo-url>
cd sc-sistema-cultura
```

2. Dependências PHP
```bash
composer install
```

3. Dependências Node
```bash
npm ci
```

4. Configurar ambiente
```bash
cp .env.example .env
php artisan key:generate
```
Recomendado para desenvolvimento/CI (SQLite):
```env
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
```
Criar o arquivo sqlite:
```bash
mkdir -p database
# PowerShell
type nul > database\database.sqlite
```

5. Compilar assets
```bash
npm run dev    # desenvolvimento
npm run build  # produção
```

6. Migrar banco de dados
```bash
php artisan migrate
```

7. Executar servidor local
```bash
php artisan serve
# Acesse http://127.0.0.1:8000
```

## Testes
Rodar testes automatizados:
```bash
php artisan test
```


No CI, o workflow usa SQLite em arquivo e executa migrations antes dos testes.

## CI (GitHub Actions)
Workflow: `.github/workflows/tests.yml`
- Matrix PHP (8.2, 8.3, 8.4)
- Prepara `.env` com SQLite, executa migrations e testes
- Instala Node e tenta build de assets
Nota: se os testes dependerem de assets compilados, mova os passos de Node (install/build) antes de `php artisan test`.

## Estilos / Sass
- Partials SCSS em `resources/css/partials/`.
- Use `@use`/`@forward` (Dart Sass) em `resources/css/app.scss`.
- Variáveis globais sugeridas em `partials/_vars.scss`.

## Boas práticas do projeto
- Partial de Blade para formulários reutilizáveis (`resources/views/.../_form.blade.php`).
- Usar `@csrf` e `@method('PUT|PATCH|DELETE')` em formulários RESTful.
- Evitar imprimir texto/linhas de debug diretamente nas views (ex.: `// filepath:`).

## Solução de problemas comuns
- `Method links does not exist`: variável na view é Collection — use `->paginate()` no controller ou remova `->links()` da view.
- `RelationNotFoundException` ao usar `with('situacao')`: `situacao` é um atributo/enumeration, não relação — remova do `with`.
- Aviso Sass: substituir `@import` por `@use` e mover declarações CSS (ex.: `:root`) para partials carregadas antes dos `@use`.

## Contribuição
- Faça branches de feature e abra PR para `main`.
- Rode `composer install`, `npm ci`, `npm run dev` e `php artisan test` antes de submeter PR.
- Siga o padrão de commits (ex.: `feat(editais): ...`, `fix(...)`, `ci(...)`).

## Licença
- Defina a licença do projeto (ex.: MIT) no arquivo `LICENSE`, se aplicável.
