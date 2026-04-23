````markdown
# Cara Menjalankan Project di Device Lain

## 1. Clone repository

```bash
git clone https://github.com/akmalrivaldi/spk-smart-marketing.git
cd spk-smart-marketing
```
````

## 2. Install dependency

```bash
composer install
```

## 3. Buat file `.env`

### Windows CMD

```bash
copy .env.example .env
```

### Git Bash / Linux / Mac

```bash
cp .env.example .env
```

## 4. Generate app key

```bash
php artisan key:generate
```

## 5. Buat database

Buat database baru di phpMyAdmin / MySQL, misalnya:

```sql
CREATE DATABASE spk_smart_marketing;
```

## 6. Atur koneksi database di `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_smart_marketing
DB_USERNAME=root
DB_PASSWORD=
```

## 7. Jalankan migration

```bash
php artisan migrate
```

## 8. Jalankan seeder

```bash
php artisan db:seed
```

## 9. Jalankan server

```bash
php artisan serve
```

## 10. Buka di browser

```text
http://127.0.0.1:8000
```

## Login default

```text
Email    : kirana@gmail.com
Password : kirana123
```

```

```
