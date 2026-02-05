# BiteSafari: AI Coding Agent Instructions

## Project Overview
BiteSafari is a Laravel 12 web application for food ordering. It uses a role-based access control system (admin/user) with an Eloquent ORM data model: Users → Orders ← Food (many-to-many through Orders). The app implements Blade templating with Tailwind CSS and Vite for asset bundling.

## Architecture & Data Model

**Key Entities:**
- **User** (role: 'admin' or 'user'): Base authentication model with `email_verified_at` hashing and `remember_token` support
- **Food** (id, name, price, description, quantity, timestamps): Menu items stored in `food` table
- **Order** (id, user_id, food_id, quantity, status, timestamps): User food purchases with enum status: pending/completed/delivered

**Relationships to Implement:**
- User hasMany Orders (add `public function orders() { return $this->hasMany(Order::class); }`)
- Food hasMany Orders (add `public function orders() { return $this->hasMany(Order::class); }`)
- Order belongsTo User/Food (add corresponding methods)

## Critical Routing Patterns

**Route Structure** (see [routes/web.php](routes/web.php)):
- Admin routes: `/admin/*` require `middleware(['auth', 'role:admin'])`
- User routes: `/user/*` require `middleware(['auth', 'role:user'])`
- Shared routes: `/profile` requires `auth` middleware
- Public route: `/` serves welcome page

**Middleware Stack:**
- `CheckRole::class` validates `auth()->user()->role` against route parameter (throws 403 if role mismatch)
- Kernel registers it at `app/Http/Middleware/` as `'role:admin'` pattern

## Development Commands

```bash
# Database setup
php artisan migrate              # Apply pending migrations
php artisan migrate:rollback     # Revert last batch
php artisan db:seed              # Run DatabaseSeeder

# Code generation
php artisan make:model [Model]   # Create model at app/Models/
php artisan make:controller [Controller] --resource  # Create resource controller
php artisan make:migration [name]  # Create migration

# Development server
php artisan serve                # Run on http://localhost:8000

# Frontend build
npm run dev                       # Vite dev server with hot reload
npm run build                     # Production build to public/build/

# Testing
php artisan test                 # Run PHPUnit tests
php artisan test --filter=[TestName]  # Run specific test
```

## Blade Template Conventions

**Located:** `resources/views/` with nested structure matching logical domains:
- `layouts/app.blade.php`: Main template wrapper with `@yield` sections
- `admin/`, `user/`: Role-specific views
- `auth/`: Authentication pages (login, register, reset)
- `components/`: Reusable Blade components
- `profile/`: User profile management

**Common Patterns:**
- Use `@auth/@guest` directives to conditionally render auth state
- Pass `user()->role` to templates to conditionally show admin/user UI
- Use Blade components: `<x-component-name :prop="value" />`

## Authentication & Authorization

**Guard:** Web-based session authentication (configured in [config/auth.php](config/auth.php))

**Role Checking:**
- Direct: `auth()->user()->role === 'admin'` or `auth()->user()->role === 'user'`
- Middleware: Use `role:admin` or `role:user` in route definitions
- Blade: `@if(auth()->user()->role === 'admin')` ... `@endif`

**Default Role:** New users get `role = 'user'` from migration default

## Form Requests & Validation

- Create form requests in `app/Http/Requests/` (use `php artisan make:request [Name]`)
- Form requests auto-inject into controller methods via type-hinting
- Example: `public function store(StoreOrderRequest $request)` validates before controller runs

## Frontend Toolchain

- **CSS:** Tailwind CSS (configured in [tailwind.config.js](tailwind.config.js))
- **Bundler:** Vite (configured in [vite.config.js](vite.config.js))
- **Entry Point:** [resources/js/app.js](resources/js/app.js) with Bootstrap config at [resources/js/bootstrap.js](resources/js/bootstrap.js)
- **Asset Path:** Use `@vite(['resources/css/app.css', 'resources/js/app.js'])` in Blade layouts

## Testing Structure

- **Unit Tests:** `tests/Unit/` - test individual methods/classes
- **Feature Tests:** `tests/Feature/` - test full request cycles
- **Base:** Extend `Tests\TestCase` (defined in [tests/TestCase.php](tests/TestCase.php))

## Configuration Sources

- **Database:** [config/database.php](config/database.php) - drivers, connections
- **Mail:** [config/mail.php](config/mail.php) - SMTP/Mailer setup
- **Session:** [config/session.php](config/session.php) - cookie/file storage
- **Cache:** [config/cache.php](config/cache.php) - Redis/File/Database backends

## File Structure Principles

- **Controllers:** One per domain ([App/Http/Controllers/{Domain}/](app/Http/Controllers/))
- **Models:** Single responsibility, relationships defined in model ([app/Models/](app/Models/))
- **Migrations:** Timestamped, reversible, one logical change per file
- **Seeders:** Use factories for test data ([database/factories/](database/factories/))

## Common Mistakes to Avoid

- **Missing Relationships:** Food & Order models are currently empty—must add `hasMany()` and `belongsTo()` methods
- **Role Typos:** Use exact strings 'admin' or 'user' (case-sensitive, defined in migration default)
- **Vite Assets:** Always use `@vite()` helper in Blade, not direct `<script>` tags
- **Migrations Not Reversible:** Always implement `down()` to drop tables/columns when rolling back
