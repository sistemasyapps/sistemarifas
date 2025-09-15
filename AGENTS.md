# Repository Guidelines

## Project Structure & Module Organization
Laravel app code lives in `app/`, with HTTP controllers, models, jobs, and services. Routes are under `routes/` (`web.php`, `api.php`, console, broadcasting). Frontend assets and Blade views sit in `resources/`, compiled by Vite into `public/`. Configuration, bootstrapping, database migrations/seeders, and tests follow Laravel defaults under `config/`, `bootstrap/`, `database/`, and `tests/`. Documentation and onboarding notes reside in `documentacion/`. Entry points are `artisan` for CLI tasks and `vite.config.js` for asset tooling.

## Build, Test, and Development Commands
Install backend dependencies with `composer install` and frontend packages with `npm install`. Copy the environment template via `cp .env.example .env` and seed the app key using `php artisan key:generate`. Run database migrations using `php artisan migrate`. Start the API/web server via `php artisan serve` and launch Vite HMR with `npm run dev`. Produce a production asset bundle with `npm run build`. Execute the automated test suite through `php artisan test` or directly with `./vendor/bin/phpunit`.

## Coding Style & Naming Conventions
Follow PSR-12 coding standards; format PHP code using `composer exec pint` (aliased to `./vendor/bin/pint`). Use 4-space indentation for PHP and 2 spaces for JavaScript, JSON, and Vue files. Name classes in PascalCase, methods and variables in camelCase, Blade view files in snake_case, and route names such as `home_nuevo`. Keep controllers thin—move reusable logic into services, jobs, or models.

## Testing Guidelines
Use PHPUnit as configured in `phpunit.xml`. Feature tests live in `tests/Feature` and unit coverage in `tests/Unit`. Name tests with the `*Test.php` suffix and scope each test method to one behavior. Run suites with `php artisan test`; add focused runs via `php artisan test --filter MethodName` when iterating. Ensure new features ship with corresponding coverage before merging.

## Commit & Pull Request Guidelines
Write imperative, concise commit messages (`fix: validar pago en OrderController`). Reference issues with `#123` when relevant. For pull requests, provide a clear summary, link related issues, attach UI screenshots for frontend changes, and note migration steps. Document test evidence (e.g., `php artisan test`) so reviewers can verify quickly.

## Security & Configuration Tips
Never commit `.env` or credentials. Confirm the app key and database credentials are configured before running migrations. For production rollouts, warm caches with `php artisan config:cache` and `php artisan route:cache`, build assets via `npm run build`, and ensure storage is linked with `php artisan storage:link` when serving user uploads.
