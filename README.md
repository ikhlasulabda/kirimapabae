# KirimApaBae 📤

A simple but secure file sharing web app built with Laravel. Upload a file, get a unique link, share it. Anyone with the link can download it.

**Live demo:** `https://kirimapabae.infinityfreeapp.com` *(coming soon)*

---

## Features

- **Unique token links** — every uploaded file gets a randomly generated 64-character token URL
- **Optional password protection** — files can be locked with a bcrypt-hashed password
- **Expiry system** — set a date/time after which the file becomes inaccessible
- **Auto-delete expired files** — scheduled background job cleans up expired files daily
- **Activity log & admin dashboard** — full audit trail of uploads, downloads, and failed attempts
- **Rate limiting** — 10 requests/minute per IP to prevent abuse
- **100% free stack** — no paid services required

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.x + Laravel 11 |
| Frontend | Blade + Tailwind CSS |
| Database | MySQL 8.x |
| Hosting | InfinityFree (free) |
| Storage | Local filesystem |

---

## How It Works

```
User uploads file
      ↓
File saved to storage/app/private/files/ with random name
      ↓
Record saved to DB with unique 64-char token
      ↓
User gets a shareable link: /file/{token}
      ↓
Recipient opens link → enters password (if any) → downloads file
```

---

## Getting Started (Local)

### Requirements

- PHP 8.x
- Composer
- MySQL 8.x

### Installation

```bash
# Clone the repo
git clone https://github.com/ikhlasulabda/kirimapabae.git
cd kirimapabae

# Install dependencies
composer install

# Copy env file
cp .env.example .env

# Generate app key
php artisan key:generate
```

### Configure `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kirimapabae
DB_USERNAME=root
DB_PASSWORD=your_password

ADMIN_PASSWORD=your_admin_password
```

### Run

```bash
# Run migrations
php artisan migrate

# Start local server
php artisan serve
```

Open `http://localhost:8000` in your browser.

---

## Admin Dashboard

Access the activity log at `/admin/logs`. Requires the `ADMIN_PASSWORD` set in your `.env` file.

Features:
- View all upload, download, failed password, and expired access events
- Delete files directly from the dashboard (removes from storage + database)
- Session expires when browser tab is closed

---

## Scheduled Job

To auto-delete expired files, set up a cron job on your server:

```
* * * * * php /path/to/artisan schedule:run
```

Or run manually:

```bash
php artisan files:delete-expired
```

---

## Security

- Passwords hashed with **bcrypt**
- Dangerous file extensions blocked on upload
- Files stored outside the public directory (`storage/app/private/`)
- Rate limiting per IP (10 req/min on download routes)
- Admin session expires on tab close

---

## License

MIT — free to use and modify.
