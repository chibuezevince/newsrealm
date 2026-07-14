<<<<<<< HEAD
# NewsRealm

A modern news and article publishing platform built with Laravel 13, featuring a Filament admin panel, article categories, comments, newsletter subscriptions, and full-text search.

## Features

- **Article Management** - Browse, search, and read articles organized by categories
- **Category Browsing** - Filter articles by category with infinite scroll / load-more support
- **Comments** - Readers can leave comments on articles
- **Newsletter** - Email newsletter subscription via a dedicated controller
- **Full-Text Search** - Search articles with paginated load-more results
- **Admin Panel** - Filament admin dashboard for managing articles, categories, comments, and settings
- **Responsive Design** - Tailwind CSS 4 for a modern, mobile-friendly UI

## Tech Stack

- **Backend:** PHP 8.3+, Laravel 13
- **Admin Panel:** Filament 5
- **Frontend:** Tailwind CSS 4, HTMX, Blade templates, Vite,.
- **Database:** MySQL / PostgreSQL (configurable)
- **Testing:** Pest 4

## Getting Started

### Prerequisites

- PHP 8.3+
- Composer
- Node.js & npm
- Database (MySQL, PostgreSQL, or SQLite)

### Installation

```bash
# Clone the repository
git clone <repository-url>
cd newsrealm

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure your database in .env, then run migrations
php artisan migrate

# Build frontend assets
npm run build

# Start the development server
php artisan serve
```

### Development

```bash
# Start the dev server with Vite hot-reloading
npm run dev
```

## Testing

```bash
# Run the test suite
php artisan test --compact
```

## Admin Panel

The admin panel is powered by Filament and is accessible at `/manager`. Run the seeder to create an new manager user:

```bash
php artisan db:seed
```

## License

This project is open-sourced under the MIT license.
=======
# newsrealm
News Realm is a basic scaffolding for a news/blog application buiilt with laravel, htmx and filament. 
>>>>>>> 00c7f62d1e508c14a9268b4f121876804ec928b6
