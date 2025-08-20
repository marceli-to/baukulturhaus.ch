# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Statamic CMS** website built on Laravel, using:
- **PHP 8.2+** with Laravel 10.8+ framework
- **Statamic CMS 5.0** for content management
- **Tailwind CSS** for styling with custom design system
- **Vite** for asset building
- **Alpine.js** for frontend interactivity

## Development Commands

### Essential Commands
- `npm run dev` - Start Vite development server with HMR
- `npm run build` - Build production assets
- `php please` - Statamic's CLI tool (equivalent to Laravel's artisan)
- `php artisan serve` - Start Laravel development server
- `composer install` - Install PHP dependencies
- `npm install` - Install Node.js dependencies

### Testing
- `vendor/bin/phpunit` - Run PHP tests

## Architecture

### Content Structure
- **Content files**: Stored in `content/` directory using YAML frontmatter + Markdown
- **Collections**: Pages are managed via `content/collections/pages/`
- **Globals**: Site-wide content in `content/globals/`
- **Navigation**: Structured navigation in `content/trees/`

### Template System
- **Layout**: `resources/views/layout/default.antlers.html` is the main layout
- **Templates**: Uses Statamic's Antlers templating engine (`.antlers.html` files)
- **Partials**: Reusable components in `resources/views/partials/`
- **Blueprints**: Content structure definitions in `resources/blueprints/`

### Asset Pipeline
- **CSS**: Main stylesheet at `resources/css/app.css` (Tailwind CSS)
- **JavaScript**: Entry point at `resources/js/app.js` (Alpine.js)
- **Fonts**: Custom ChromaST fonts in `resources/css/fonts/`
- **Build**: Vite configuration in `vite.config.js` with Laravel plugin

### Styling System
- **Custom Tailwind Config**: Extensive custom spacing scale (1-250) with 0.0625rem increments
- **Typography**: ChromaST fonts (Medium/Regular variants)
- **Custom Font Sizes**: xs (16px) through 2xl (55px)
- **Design Tokens**: Defined in `tailwind.config.js`

### Key Directories
- `app/` - Laravel application code, custom tags in `app/Tags/`
- `resources/views/` - Antlers templates and partials
- `resources/blueprints/` - Content structure definitions
- `content/` - All CMS content (pages, globals, navigation)
- `public/assets/` - Static assets and uploads

### Development Notes
- Uses Statamic's "flat-first" approach with Git-based content management
- Local development URL configured for `baukulturhaus.ch.test`
- Vite HMR configured for localhost
- No Vue.js despite dependencies (commented out in vite.config.js)