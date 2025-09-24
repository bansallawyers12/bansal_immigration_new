# Post-pull setup guide

Follow these steps after pulling the latest code to get the app running locally.

## 1) Environment
- Copy env if missing: `copy .env.example .env` (PowerShell: `cp .env.example .env`)
- Generate key: `php artisan key:generate`
- Ensure DB is configured in `.env` (SQLite/MySQL/PostgreSQL). For SQLite, set:
  - `DB_CONNECTION=sqlite`
  - Create file: `database\\database.sqlite`

## 2) Dependencies
- PHP deps: `composer install`
- JS deps: `npm install`

## 3) Assets
- Dev: `npm run dev`
- Prod build (optional): `npm run build`

## 4) Storage links (if not already created)
- `php artisan storage:link`

## 5) Database migrations
- Run migrations: `php artisan migrate`

## 6) Data files required
- Ensure CSV exists: `storage/app/australian_postcodes.csv`
  - Columns: `postcode,locality,state`

## 7) Seed data
- Seed suburbs from CSV: `php artisan db:seed --class=SuburbSeeder`
- Seed postcode ranges (Categories 1–3): `php artisan db:seed --class=PostcodeRangeSeeder`

## 8) Clear/optimize caches (optional)
- `php artisan optimize:clear`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

## 9) Run the app
- Local PHP server: `php artisan serve`
- Or via your web server (e.g., XAMPP) pointing to `public/`

## 10) Verify postcode checker
- Visit `/postcode-checker`
- Test examples: `2000` (Category 1), `3216` (Category 2), `2480` (Category 3)

## Notes
- Category logic is populated by `PostcodeRangeSeeder`. Any postcode not covered by Category 2/3 ranges is treated as Category 1.
- Policies change; the info text in the tool is general guidance only.
