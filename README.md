# Bansal Immigration Website

A comprehensive Laravel-based immigration services website with admin panel, appointment booking, and client management features.

## Features

- **Frontend**
  - Modern responsive design with Tailwind CSS
  - Service pages and detailed service information
  - Blog system with categories and search
  - Contact forms and appointment booking
  - Client testimonials and gallery
  - Multi-language support

- **Admin Panel**
  - Dashboard with analytics
  - Content management (pages, services, blogs)
  - Client management and enquiry tracking
  - Appointment scheduling and management
  - User management and role-based access
  - Media gallery management

- **Core Functionality**
  - User authentication and authorization
  - Database migrations and seeders
  - Email notifications
  - File upload and management
  - SEO optimization
  - Mobile-responsive design

## Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: SQLite (development) / MySQL (production)
- **JavaScript**: Vanilla JS with Alpine.js components
- **Build Tools**: Vite
- **PDF Processing**: pdftk for form handling

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/bansal-immigration.git
   cd bansal-immigration
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build frontend assets**
   ```bash
   npm run dev
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## Configuration

- Update `.env` file with your database credentials
- Configure mail settings for email notifications
- Set up file storage paths as needed
- Update site configuration in the admin panel

## Default Admin Access

After running the seeders, you can access the admin panel with:
- **Email**: admin@bansalimmigration.com
- **Password**: Check the AdminUserSeeder for the default password

## Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Mail/                # Email classes
│   └── View/Components/     # Blade components
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── public/                 # Public assets
└── routes/                 # Application routes
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions, please contact the development team or create an issue in the repository.

---

**Bansal Immigration** - Your trusted partner for immigration services.