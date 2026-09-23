# QR SaaS

QR SaaS is a Laravel application for generating QR codes, managing free and Pro subscriptions, tracking scans, and supporting a real admin dashboard.

## Features

- QR code generation with a free-tier limit and Pro upgrade flow
- Stripe checkout and webhook-based activation
- Invoice email delivery after successful Pro purchase
- Admin dashboard for users, QR records, and revenue overview
- Public landing page and pricing page with SEO metadata
- Lightweight API health endpoints

## Local setup

1. Copy `.env.example` to `.env`
2. Configure your database and Stripe credentials
3. Run:
   - `composer install`
   - `php artisan key:generate`
   - `php artisan migrate`
   - `php artisan db:seed`
   - `php artisan serve`

## Production deployment checklist

- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Set `APP_URL` to your production domain
- Configure real Stripe keys in `.env`:
  - `STRIPE_KEY`
  - `STRIPE_SECRET`
  - `STRIPE_WEBHOOK_SECRET`
- Configure mail provider and default sender
- Set up a production database and cache/queue driver
- Run `php artisan config:cache`
- Run `php artisan route:cache`
- Run `php artisan view:cache`
- Serve behind HTTPS and a reverse proxy such as Nginx or Apache
- Add the Stripe webhook endpoint to your Stripe dashboard

## Admin account

Seeded default admin login:
- Email: `naina@admin.com`
- Password: `naina123@`

## API endpoints

- `GET /api/health`
- `GET /api/ping`

## License

This project is for internal application use unless otherwise specified.
