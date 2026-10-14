# Zild Cafe – Laravel backend + MySQL schema (XAMPP)

Laravel backend and Blade website for Zild Cafe (menu, cart, checkout, blog, team, reviews, contact).
The pages render through Laravel routes and Blade templates; CSS, JavaScript, and images remain in `public/site/` as public assets.

This folder is an **overlay**: it contains the app code (models, controllers, routes, migrations, seeders) that gets
copied on top of a fresh Laravel install, so you always get a clean, up-to-date Laravel underneath.

```
app/        models, API controllers, admin middleware
database/   11 migrations, seeders, zild_cafe.sql (phpMyAdmin import)
routes/     api.php (all endpoints), web.php
resources/views/site  website pages as Blade templates
public/site           CSS, JavaScript, and image assets
setup.bat   one-click XAMPP setup (Windows)
```

## Requirements
- XAMPP with **PHP 8.2+** and MySQL/MariaDB (check with `C:\xampp\php\php.exe -v`)
- [Composer](https://getcomposer.org/Composer-Setup.exe)

## Setup – one click (Windows)
1. Open the **XAMPP Control Panel** → start **MySQL** (and Apache).
2. Double-click **`setup.bat`**.
   The installer connects Laravel to the existing `zild_cafe` database and preserves its data. It only runs migrations and seeders when the database has no tables; a partial schema stops setup without changing it.
3. When it says DONE:
   ```
   cd C:\xampp\htdocs\zild-cafe
   php artisan serve
   ```
   - Website: http://127.0.0.1:8000
   - API: http://127.0.0.1:8000/api/menu
   - phpMyAdmin: http://localhost/phpmyadmin → database `zild_cafe`

## Setup – manual (any OS)
```bash
composer create-project laravel/laravel zild-cafe
cd zild-cafe
```
Create the database `zild_cafe` (phpMyAdmin → New, collation `utf8mb4_unicode_ci`), then in `.env` set:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zild_cafe
DB_USERNAME=root
DB_PASSWORD=
```
```bash
php artisan install:api            # adds Sanctum (API tokens)
# copy this folder's app/, database/, routes/, public/ over the project (overwrite when asked)
php artisan storage:link
php artisan migrate --seed
php artisan serve
```

## Alternative: import the SQL only (phpMyAdmin)
`database/zild_cafe.sql` creates the `zild_cafe` database, every table, and starter menu/blog/team/reviews data. It includes a development-only customer account and no admin account; do not import the demo customer into a live database. It includes the saved delivery-location fields used by the current checkout.
Phpmyadmin → **Import** → choose the file. If it is already imported, do not import again. Setup detects the existing schema and will not run migrations or seeders over it.

## Local development logins (password `password`)

These accounts are created only when the seeder runs outside production. Never use them on a live site.

| Email | Role |
|---|---|
| admin@zildcafe.com | admin |
| customer@example.com | customer, 500.00 credits |

For a production install, set these values in `.env` before running the seeder. Use a unique, randomly generated password of at least 12 characters and keep `.env` private:
```
ZILD_ADMIN_NAME="Cafe Administrator"
ZILD_ADMIN_EMAIL=owner@example.com
ZILD_ADMIN_PHONE=
ZILD_ADMIN_PASSWORD="use-a-unique-random-secret"
```
Outside `APP_ENV=local` or `APP_ENV=testing`, the seeder does not create demo accounts. It creates or updates only the configured admin, revokes the old seeded admin if present, and fails explicitly if the email or password is missing/invalid. Do not import the demo customer account from `database/zild_cafe.sql` into a live database.

## Database schema
| Table | Purpose | Key columns |
|---|---|---|
| `users` | customers + admins | `role` (customer/admin), `phone`, saved delivery address and coordinates, `credits` |
| `categories` | Drinks, Snacks | `name`, `slug` |
| `products` | the 17 menu items | `category_id`, `price`, `image`, `is_available`, `is_featured` |
| `product_sizes` | "Select a Size" options (Tall/Grande/Venti, Regular/Footlong…) | `product_id`, `name`, `code`, `price_modifier`, `is_default` |
| `carts`, `cart_items` | server-side cart, found via a token | `token`, `product_id`, `product_size_id`, `quantity` |
| `orders` | checkout form + status | `order_number`, `customer_name`, `address`, `delivery_latitude`, `delivery_longitude`, `phone`, `payment_method` (cod/paymaya/gcash/credits), `payment_status`, `status`, `total` |
| `order_items` | snapshot of what was bought | `product_name`, `size_name`, `unit_price`, `quantity` |
| `blog_posts` | blog + "read more" pages | `slug`, `excerpt`, `content`, `is_published` |
| `reviews` | "What our customers say" | `rating` (1-5), `is_approved` |
| `team_members` | team page | `position`, `bio`, `photo` |
| `contact_messages` | contact form inbox | `is_read` |
| `settings` | phone, email, address, opening hours | `key`, `value` |

Relationships: category 1─* products 1─* product_sizes · cart 1─* cart_items · order 1─* order_items · user 1─* orders/carts.
Order items copy name/size/price, so changing the menu later never alters past orders.

## API (base URL `http://127.0.0.1:8000/api`)

Website sign-in and customer account registration are available at `http://127.0.0.1:8000/login.html`. Registration creates a customer account and signs it in; this page accepts customer accounts only.
Administrators sign in at `http://127.0.0.1:8000/admin/login`. The dashboard at `http://127.0.0.1:8000/admin/dashboard` provides live metrics, order search and filters, and confirm, reject, and status-update controls. Order statuses follow a one-way workflow: pending → preparing → out for delivery → completed; pending or in-progress orders can be cancelled. Paid credit orders are refunded automatically on cancellation, and payment status cannot be moved backwards.

Before their first checkout, customers are sent to `/delivery-location.html` to save a delivery address and map pin on their account. They return to checkout after saving; later orders reuse that location. Checkout does not let customers edit the address; changes are made from Manage Account only. If upgrading an existing Laravel install, copy the new migration and run `php artisan migrate`. If using a database imported from an older `zild_cafe.sql`, add the new nullable fields once in phpMyAdmin:
```sql
ALTER TABLE users
  ADD delivery_address TEXT NULL AFTER phone,
  ADD delivery_latitude DECIMAL(10,7) NULL AFTER delivery_address,
  ADD delivery_longitude DECIMAL(10,7) NULL AFTER delivery_latitude;
```

**Public**
| Method | URL | What |
|---|---|---|
| GET | `/menu` | categories with products + sizes |
| GET | `/products?category=drinks&q=matcha&featured=1` | filtered product list |
| GET | `/products/{slug}` | one product |
| GET | `/cart` | current cart (send header `X-Cart-Token`; a new cart + token is created if missing) |
| POST | `/cart/items` | `{product_id, product_size_id?, quantity?}` |
| PATCH / DELETE | `/cart/items/{id}` | change quantity / remove |
| DELETE | `/cart` | empty the cart |
| POST | `/orders` | authenticated checkout: `{payment_method, notes?}` + `X-Cart-Token`; saved address/pin, customer name, and phone come from the account |
| GET | `/orders/track?order_number=…&phone=…` | guest order lookup |
| GET | `/blog`, `/blog/{slug}`, `/team`, `/reviews`, `/settings` | website content |
| POST | `/reviews`, `/contact` | submit a review (waits for approval) / contact message |
| POST | `/register`, `/customer/login` | create or sign in customer account; returns `{user, token}` |
| PATCH | `/me/delivery-location` | authenticated customer saves `{delivery_address, delivery_latitude, delivery_longitude}` |
| POST | `/admin/login` | admin-only sign-in; returns `{user, token}` |
| POST | `/login` | legacy general API sign-in |

**Logged in** (header `Authorization: Bearer <token>`): `POST /logout`, `GET /me`, `GET /my-orders`.
Paying with `credits` needs a logged-in user with enough balance.

**Admin** (token of an admin user), prefix `/api/admin`:
`GET /dashboard` · `products`, `categories`, `blog-posts`, `team-members` (full CRUD) · `orders` (list/show, `PATCH {status, payment_status}`) · `reviews` (approve with `PATCH {is_approved:true}`) · `messages`.
Product images: send `image_file` as multipart **POST** with `_method=PATCH` (PHP can't read multipart on a real PATCH).

Quick test:
```bash
curl http://127.0.0.1:8000/api/menu
curl -X POST http://127.0.0.1:8000/api/login -H "Accept: application/json" -H "Content-Type: application/json" \
     -d '{"email":"admin@zildcafe.com","password":"password"}'
```
Always send `Accept: application/json` so errors come back as JSON.

## Things to know
- **Sizes don't change the price** – your site only passes the size in the URL. Every `price_modifier` is 0; set e.g. `20.00` on "Venti" in `product_sizes` to charge more.
- **The website uses the existing database for menu items, blog posts, team members, reviews, cart contents, and orders.** Menu additions, cart updates, and checkout use the Laravel API; the numbered legacy cart URLs all open the shared database cart.
- **Customer registration requires a phone number.** Checkout uses the signed-in account's name and phone automatically. Before the first order, customers save their delivery address and pin on a dedicated map setup page; checkout redirects them there if no location is saved.
- Source-site issues I noticed: a few image links point to files that don't exist (`owner_zild.jpg`, `zild_coffee.jpg`, `zild-logo-dark.png`, `coffee-bg.jpg`, `hero-background.jpg`), and the blog cards' titles don't match their "read more" content (e.g. "Coffee and Health" opens a burger article). The seed data keeps the site as-is.
- Verified locally with PHP 8.2 and XAMPP MariaDB: Laravel tests, Blade compilation, role-specific sign-in, and admin order confirmation/rejection pass.
