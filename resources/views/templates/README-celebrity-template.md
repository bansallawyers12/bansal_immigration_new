# Celebrity Visa Template Documentation

## Overview
The `celebrity-visa-template.blade.php` is a reusable template designed specifically for showcasing celebrity visa success stories and testimonials. It provides a grand, modern design with animations, effects, and professional styling.

## Usage

### Basic Usage
```php
@extends('templates.celebrity-visa-template')

@section('celebrity_content')
    <!-- Your custom celebrity content goes here -->
@endsection
```

### Advanced Usage with Variables
```php
@extends('templates.celebrity-visa-template')

@php
    $page_title = 'Bollywood Stars in Australia';
    $page_description = 'Success stories of Bollywood celebrities who migrated to Australia';
    $hero_title = 'Bollywood Success Stories';
    $hero_subtitle = 'From Bollywood to Australia - Celebrity Migration Success';
    $category_badges = ['Bollywood Stars', 'Film Actors', 'TV Personalities', 'Music Artists'];
    $stats = [
        [
            'number' => '25+',
            'label' => 'Bollywood Stars',
            'description' => 'Successfully migrated'
        ],
        [
            'number' => '100%',
            'label' => 'Success Rate',
            'description' => 'Visa approval rate'
        ]
    ];
    $celebrity_categories = [
        [
            'title' => 'Bollywood Stars',
            'subtitle' => 'Lights, Camera, Australia!',
            'description' => 'Success stories of Bollywood celebrities',
            'icon' => '🎬',
            'badge_color' => 'bg-gradient-to-r from-yellow-400 to-orange-500',
            'celebrities' => [
                [
                    'name' => 'Anonymous Bollywood Star',
                    'category' => 'Film Actor',
                    'description' => 'Successfully obtained Australian permanent residency...',
                    'testimonial' => 'Bansal Immigration made my Australian dream come true...',
                    'image_icon' => '🎭',
                    'image_bg' => 'bg-gradient-to-br from-purple-400 to-pink-500',
                    'badge_color' => 'bg-gradient-to-r from-purple-400 to-pink-500'
                ]
            ]
        ]
    ];
@endphp
```

## Template Variables

### Required Variables (Optional)
- `$page_title` - Page title for SEO
- `$page_description` - Page description for SEO
- `$hero_title` - Main hero section title
- `$hero_subtitle` - Hero section subtitle
- `$category_badges` - Array of category badges to display
- `$stats` - Array of statistics to display
- `$celebrity_categories` - Array of celebrity categories and their stories
- `$features` - Array of features/benefits to highlight
- `$cta_title` - Call-to-action section title
- `$cta_subtitle` - Call-to-action section subtitle
- `$form_title` - Contact form title
- `$form_subtitle` - Contact form subtitle
- `$form_source` - Form source identifier
- `$form_variant` - Form variant for styling

### Default Values
If variables are not provided, the template uses sensible defaults:
- Hero title: "Celebrity Visas"
- Default category badges: Bollywood Stars, Punjabi Artists, Religious Leaders, Cultural Ambassadors
- Default stats: 50+ Celebrity Clients, 100% Success Rate, 15+ Years Experience, 24/7 Support
- Default features: Specialized Expertise, Confidentiality, Fast Processing, 24/7 Support

## Features

### Visual Effects
- **Animated Background**: Floating particles with gradient background
- **Floating Elements**: Subtle floating animation for hero content
- **Hover Effects**: 3D transform effects on celebrity cards
- **Smooth Animations**: Intersection observer for scroll-triggered animations
- **Counter Animation**: Animated statistics counters

### Responsive Design
- Mobile-first approach
- Responsive grid layouts
- Adaptive typography
- Touch-friendly interactions

### Accessibility
- Semantic HTML structure
- ARIA labels for interactive elements
- Keyboard navigation support
- High contrast color schemes

## Customization

### Colors
The template uses CSS custom properties that can be overridden:
```css
.celebrity-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
}
```

### Animations
Custom animations can be added by extending the existing CSS:
```css
@keyframes customAnimation {
    /* Your animation keyframes */
}
```

### Layout
The template uses CSS Grid and Flexbox for layouts, making it easy to customize:
```css
.grid {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}
```

## Examples

### Example 1: Bollywood Stars Page
```php
@extends('templates.celebrity-visa-template')

@php
    $hero_title = 'Bollywood Stars in Australia';
    $category_badges = ['Bollywood Stars', 'Film Actors', 'TV Personalities'];
    $stats = [
        ['number' => '30+', 'label' => 'Bollywood Stars', 'description' => 'Successfully migrated'],
        ['number' => '100%', 'label' => 'Success Rate', 'description' => 'Visa approval rate']
    ];
@endphp
```

### Example 2: Punjabi Artists Page
```php
@extends('templates.celebrity-visa-template')

@php
    $hero_title = 'Punjabi Artists Down Under';
    $category_badges = ['Punjabi Singers', 'Musicians', 'Cultural Ambassadors'];
    $stats = [
        ['number' => '20+', 'label' => 'Punjabi Artists', 'description' => 'Successfully migrated'],
        ['number' => '100%', 'label' => 'Success Rate', 'description' => 'Visa approval rate']
    ];
@endphp
```

## Best Practices

1. **Performance**: Optimize images and use lazy loading for celebrity photos
2. **Content**: Use real testimonials and success stories when possible
3. **SEO**: Provide meaningful page titles and descriptions
4. **Accessibility**: Ensure all content is accessible to screen readers
5. **Mobile**: Test on various devices and screen sizes

## Support

For questions or issues with the celebrity template, contact the development team or refer to the main project documentation.
