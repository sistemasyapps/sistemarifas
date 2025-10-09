# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

**Setup:**
- Install backend: `composer install`
- Install frontend: `npm install`
- Environment setup: `cp .env.example .env && php artisan key:generate`
- Database setup: `php artisan migrate`

**Development:**
- Start Laravel server: `php artisan serve`
- Start Vite dev server: `npm run dev`
- Build production assets: `npm run build`

**Testing:**
- Run all tests: `php artisan test`
- Run PHPUnit directly: `./vendor/bin/phpunit`
- Run specific test: `php artisan test --filter TestName`

**Code Quality:**
- Format PHP code: `./vendor/bin/pint` or `composer exec pint`
- Cache optimization (production): `php artisan config:cache && php artisan route:cache`

## Architecture Overview

This is a **Laravel 12** application with **Filament Admin Panel** and **Livewire** components. The frontend uses **Vue 3** with **Vite** for asset compilation.

**Key Technologies:**
- Backend: Laravel 12, PHP 8.2+, Filament 3.3, Livewire 3.5
- Frontend: Vue 3, Vite, jQuery, SweetAlert2, Swiper
- Database: Laravel Eloquent ORM with migrations
- Queue/Jobs: Laravel queue system with Redis support (Predis)
- Authentication: Laravel Sanctum
- External Services: Firebase integration, IP geolocation

**Directory Structure:**
- `app/Http/Controllers/` - HTTP request handlers
- `app/Models/` - Eloquent models and database entities
- `app/Filament/` - Filament admin panel resources and widgets
- `app/Jobs/` - Background job classes
- `app/Services/` - Business logic services
- `app/Mail/` - Email templates and mailers
- `routes/` - Route definitions (web.php, api.php, console.php, channels.php)
- `resources/views/` - Blade templates (compra.blade.php, home.blade.php, etc.)
- `resources/js/` and `resources/css/` - Frontend assets compiled by Vite
- `tests/Feature/` and `tests/Unit/` - PHPUnit test suites

**Application Pattern:**
- Follow Laravel MVC pattern with thin controllers
- Use Jobs for background processing and complex business logic
- Filament provides admin interface with automatic CRUD operations
- Livewire handles interactive components without JavaScript
- Vue components for complex frontend interactions

**Coding Standards:**
- PHP: PSR-12 standard via Laravel Pint
- Indentation: PHP (4 spaces), JS/JSON (2 spaces)
- Naming: Classes (PascalCase), methods (camelCase), Blade views (snake_case), routes (snake_case)
- Keep routes thin, move complex logic to Services or Jobs

**Testing Environment:**
- Tests run in isolated environment with array cache/session drivers
- Feature tests for HTTP endpoints and user workflows
- Unit tests for isolated business logic
- Test database can be SQLite in-memory or separate test database

## System Configuration

**Credentials:**
- Sudo password: `a18671986`

**Database Configuration:**
- Database: `sistema_rifas`
- User: `ds000082`
- Password: `a18671986`
- Connection: MySQL/MariaDB on localhost:3306

**Redis Configuration:**
- Redis server running on localhost:6379
- Used for caching, sessions, and queue management
- Service: `redis-server.service` (enabled for auto-start)
- Test connection: `redis-cli ping` should return `PONG`

**Services Management:**
- Start/stop Redis: `sudo systemctl start/stop redis-server`
- Check Redis status: `systemctl status redis-server`
- Restart services after config changes

## E2E Testing with Playwright & Claude Code

**MCP Integration:**
- Playwright MCP installed and configured: `claude mcp list` shows "playwright: ✓ Connected"
- Interactive browser automation available through Claude Code
- Use MCP for debugging and test generation

**Testing Commands:**
- Run E2E tests: `npm run test:e2e`
- Interactive testing: `npm run test:e2e:ui`
- Debug mode: `npm run test:e2e:debug`
- Generate tests: `npm run test:e2e:codegen`
- View reports: `npm run test:e2e:report`

**QA Specialist Subagent:**
- Location: `.claude/agents/laravel-qa-playwright-specialist.md`
- Specializes in Laravel + Playwright integration testing
- Invocation: "Use the laravel-qa-playwright-specialist subagent to..."
- Covers: E2E testing, Page Object Models, Laravel Feature tests, Cross-browser testing

**Test Structure:**
```
tests/e2e/
├── fixtures/test-data.js     # Test data generators
├── pages/                    # Page Object Models
├── *.spec.js                 # Test specifications
└── global-setup.js           # Test environment setup
```

**Key Testing Features:**
- Automated 3-step raffle purchase flow testing
- Mobile-first responsive design validation
- Cross-browser compatibility (Chrome, Firefox, Safari)
- Screenshot/video capture on failures
- Laravel server auto-start integration