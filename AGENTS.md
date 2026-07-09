# AGENTS.md - Calculadoras de Estadística

## Project Overview

Laravel 11 platform for statistical calculators (Spanish language). All UI text, routes, and variable names are in Spanish.

## Quick Start

```bash
composer install    # Creates database.sqlite + runs migrations automatically
php artisan serve   # Start dev server on http://localhost:8000
npm install && npm run dev  # Vite frontend assets
```

## Database

- **Engine**: SQLite (`database/database.sqlite`)
- The file is gitignored. `composer install` auto-creates it and runs migrations.
- If the file is missing after clone: `php artisan migrate` (will error without the file). Create it manually: `touch database/database.sqlite` then run migrations.
- `SESSION_DRIVER`, `CACHE_STORE`, and `QUEUE_CONNECTION` all use `database` driver in `.env` — they depend on the SQLite file existing.

## Architecture

### Controllers

| File | Purpose |
|------|---------|
| `StatisticsController.php` | Central tendency (mean/median/mode), sample size, frequency tables (grouped & ungrouped) |
| `FunctionsController.php` | Position measures (quartiles/deciles/percentiles), coefficients (Fisher/Bowley/Curtosis/Pearson), Pareto chart |
| `FuncionesController.php` | Legacy controller — kept but routes mostly point to StatisticsController |

### Routes (`routes/web.php`)

- Spanish routes: `/medididas-de-tendencia-central/...`, `/tablas-de-distribucion-de-frecuencias/...`, `/Medidas-de-posicion/...`, `/Calculadoras-extras/...`
- Note the typo: routes use `medididas` (double d) — do not "fix" this, it would break existing links.

### Views (`resources/views/`)

Blade templates. Each calculator has its own view file (e.g., `Cuartiles.blade.php`, `CoeficienteFisher.blade.php`). Layout at `layouts/app.blade.php`.

## Frontend

- **Vite** with `laravel-vite-plugin`
- Entry points: `resources/css/app.css`, `resources/js/app.js`
- Build: `npm run dev` (watch) or `npm run build` (production)

## Docker

- `Dockerfile`: PHP 8.2 + Apache
- `default.conf`: Apache vhost config
- Build: `docker build -t calculadoras .`
- Run: `docker run -p 8080:80 calculadoras`

## Testing

```bash
php artisan test           # Run all tests
php artisan test --filter=ExampleTest  # Single test
```

Tests exist in `tests/Unit/` and `tests/Feature/` but are minimal (example tests only).

## Available Skills (`.agents/skills/`)

**Always load the relevant skill(s) for each task.** The model must automatically detect the task type and load the appropriate skill before implementing.

| Skill | When to Load |
|-------|--------------|
| `laravel-patterns` | Architecture decisions, controllers, services, Eloquent models, migrations, queues, events, caching, API resources |
| `laravel-specialist` | Creating models/migrations, Sanctum auth, Horizon queues, Livewire components, Eloquent query optimization, Laravel testing |
| `php-pro` | Writing strict-typed PHP 8.2+, DTOs/value objects, PSR-12 compliance, PHPStan level 9, Symfony patterns |
| `vite` | Vite config changes, plugin setup, build optimization, SSR, Rolldown migration |
| `frontend-design` | Building or redesigning UI components, Blade views, landing pages, visual styling |
| `tailwind-css-patterns` | Tailwind CSS utility-first styling, responsive layouts, design systems, dark mode, CSS workflow optimization |
| `seo` | Meta tags, structured data (JSON-LD), sitemaps, canonical URLs, search optimization |
| `accessibility` | WCAG 2.2 compliance, keyboard navigation, screen reader support, ARIA patterns, color contrast |
| `nodejs-backend-patterns` | Node.js/Express/Fastify servers, REST/GraphQL APIs, middleware, authentication, microservices |
| `nodejs-best-practices` | Node.js architecture decisions, framework selection, async patterns, security, deployment |

## Gotchas

- **Session/Cache/Queue depend on SQLite**: If `database.sqlite` is missing, these will fail silently or throw errors. Always ensure the file exists.
- **No `.env` generation on clone**: `post-root-package-install` copies `.env.example` to `.env`, but only on `composer create-project`, not on clone. After cloning, run `cp .env.example .env && php artisan key:generate`.
- **No CI/CD configured**: No `.github/workflows` directory exists.
- **Spanish typo in routes**: `/medididas-de-tendencia-central/` (double d) is intentional.
- **No Eloquent models**: Only `User.php` exists. Calculations don't use the database for business logic.
