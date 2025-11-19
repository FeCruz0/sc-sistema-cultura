<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

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
# ou Linux/WSL
# touch database/database.sqlite
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
php artisan test --verbose
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
