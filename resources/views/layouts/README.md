# Layout System Documentation

## Overview
This project now uses a modular layout system with reusable header and footer components.

## Files Created

### 1. Main Layout (`layouts/main.blade.php`)
- Contains the complete HTML structure
- Includes header, footer, and floating action buttons
- Has all the CSS styles and JavaScript functionality
- Uses Blade sections for content injection

### 2. Header Component (`components/header.blade.php`)
- Reusable header with navigation
- Mobile-responsive menu
- Logo and action buttons
- Sub-navigation bar

### 3. Footer Component (`components/footer.blade.php`)
- Reusable footer with company information
- Service links, contact details, and legal links
- Responsive grid layout
- Dynamic copyright year

## How to Use

### For New Pages
```php
@extends('layouts.main')

@section('title', 'Your Page Title')
@section('description', 'Your page description')

@section('content')
    <!-- Your page content here -->
@endsection

@push('styles')
    <!-- Additional CSS if needed -->
@endpush

@push('scripts')
    <!-- Additional JavaScript if needed -->
@endpush
```

### For Existing Pages
1. Change `@extends('layouts.frontend')` to `@extends('layouts.main')`
2. Move title and description to `@section('title')` and `@section('description')`
3. Move any additional meta tags to `@push('styles')`
4. Ensure your content is wrapped in `@section('content')`

## Features

### Responsive Design
- Mobile-first approach
- Responsive navigation
- Mobile-optimized floating buttons

### SEO Optimized
- Proper meta tags
- Structured data support
- Open Graph tags support

### Performance
- Cached components
- Optimized CSS and JavaScript
- Minimal external dependencies

## Customization

### Adding New Navigation Items
Edit `resources/views/components/header.blade.php` and add your links to the appropriate sections.

### Modifying Footer
Edit `resources/views/components/footer.blade.php` to update company information, links, or contact details.

### Styling
All styles are contained in `layouts/main.blade.php`. You can:
- Modify existing styles
- Add new CSS classes
- Use `@push('styles')` for page-specific styles

## Examples

### Home Page
```php
@extends('layouts.main')

@section('title', 'Bansal Immigration - Expert Australian Migration Services')
@section('description', 'Professional Australian immigration consultants...')

@section('content')
    <!-- Hero section -->
    <!-- Services section -->
    <!-- Blog section -->
    <!-- Testimonials section -->
    <!-- Team section -->
    <!-- CTA section -->
@endsection
```

### About Page
```php
@extends('layouts.main')

@section('title', 'About Us - Bansal Immigration Consultants')
@section('description', 'Learn about our team and services...')

@section('content')
    <!-- About content -->
@endsection
```

## Benefits

1. **Consistency**: All pages use the same header and footer
2. **Maintainability**: Update header/footer in one place
3. **Performance**: Shared CSS and JavaScript
4. **SEO**: Consistent meta tags and structure
5. **Responsive**: Mobile-optimized across all pages
