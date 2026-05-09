# KirimApaBae 📦

> Send files to anyone. No fuss, no account needed.

**KirimApaBae** is a simple file sharing web app that lets anyone upload a file and instantly get a shareable download link. no registration, no hassle.

🌐 **Live:** [kirimapabae.rf.gd](https://kirimapabae.rf.gd)

---

## ✨ Features

- **File Upload**: Drag & drop or click to upload, up to 30MB
- **Instant Download Link**: Get a unique link right after uploading
- **Auto QR Code**: QR code generated automatically for offline sharing
- **Password Protection**: Optional password for private file sharing
- **Expiry Date**: Set when the download link automatically expires
- **Sender Note**: Add a personal message for the file recipient
- **Download Counter**: Recipients can see how many times the file has been downloaded

---

## 🛠️ Tech Stack

| Layer | Tech |
|---|---|
| Framework | Laravel 11 |
| PHP | ^8.2 |
| Database | MySQL |
| Frontend | Blade + Tailwind CSS (CDN) |
| Storage | Local Filesystem |
| Hosting | InfinityFree |

---

## 🚀 Local Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL

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

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kirimapabae
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Start the server
php artisan serve
```

Open `http://localhost:8000` in your browser.

---

## 📁 File Storage

Uploaded files are stored at:
```
storage/app/private/private/files/
```

Download links use auto-generated unique tokens, files are never directly accessible via URL.

---

## ⚙️ Key Environment Variables

```env
APP_URL=https://kirimapabae.rf.gd
FILESYSTEM_DISK=local
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
ADMIN_PASSWORD=your_admin_password
```

---

## 📌 Deployment Notes (InfinityFree)

- Manually create `storage/app/private/private/files/` via file manager before first upload
- PHP version: 8.3 (Laravel 11 compatible)
- Use `file` driver for session and cache (not `database`)
- Upload files via FileZilla, use mobile hotspot if ISP blocks FTP port 21
- Run migrations via phpMyAdmin import

---

## 👤 Author

**Abda** — [@ikhlasulabda](https://github.com/ikhlasulabda)

---

> *"No cap, it's not complicated. Just drop, upload, share the link, done."*
