# Repository Guidelines

## Project Structure & Module Organization
- `app/`: Laravel application code (HTTP controllers, models, jobs).
- `routes/`: Route definitions (`web.php`, `api.php`, broadcasting, console).
- `resources/`: Frontend assets and views (`css/`, `js/`, `views/`). Vite compiles to `public/`.
- `config/`, `bootstrap/`, `database/`, `public/`, `tests/`: Standard Laravel folders. Docs live in `documentacion/`.
- Entry points: `artisan` (CLI), `vite.config.js` (asset build).

## Build, Test, and Development Commands
- Install backend: `composer install`
- Install frontend: `npm install`
- Configure env: `cp .env.example .env && php artisan key:generate`
- Run DB migrations: `php artisan migrate`
- Start app: `php artisan serve` (API/web) and `npm run dev` (Vite HMR)
- Production build: `npm run build`
- Test suite: `./vendor/bin/phpunit` or `php artisan test`

## Coding Style & Naming Conventions
- PHP style: PSR-12 via Pint. Format with `./vendor/bin/pint` (or `composer exec pint`).
- Indentation: PHP 4 spaces; JS/JSON 2 spaces.
- Naming: Classes PascalCase, methods camelCase, Blade views snake_case, route names snake_case (e.g., `home_nuevo`).
- Controllers in `App\\Http\\Controllers\\...`; keep routes thin and move logic to services/jobs where possible.

## Testing Guidelines
- Framework: PHPUnit (see `phpunit.xml`). Tests in `tests/Feature` and `tests/Unit`.
- Naming: `*Test.php`, one assertion focus per behavior. Prefer Feature tests for routes/controllers; Unit tests for pure domain logic.
- Running: `php artisan test` (uses testing env), CI-friendly: `./vendor/bin/phpunit`.

## Commit & Pull Request Guidelines
- Messages: short, imperative, and descriptive (English or Spanish OK). Example: `fix: validar pago en OrderController`.
- Reference issues with `#123` when applicable. Group related changes; avoid noisy commits.
- PRs must include: clear description, linked issue, screenshots for UI changes, migration notes, and testing steps.

## Security & Configuration Tips
- Never commit `.env` or secrets. Required keys: app key, DB creds; configure third-party services (e.g., Firebase, Pusher) when used.
- Cache warmups for prod: `php artisan config:cache && php artisan route:cache`.
- Assets: update via Vite (`npm run build`). Symlink storage if needed: `php artisan storage:link`.

## Architecture Overview
- Laravel MVC with Livewire/Filament for admin UI and Vue/Vite for assets. Business logic resides in `app/` with events/jobs for background work.
