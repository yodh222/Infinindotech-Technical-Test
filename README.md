# Infinindotech Technical Test

## Deskripsi

Aplikasi ini memungkinkan pengguna mencatat pesanan pelanggan, menghitung total biaya, dan mencetak invoice dalam format PDF.

## Fitur

-   Manajemen pelanggan dan produk
-   Pembuatan invoice otomatis
-   Export invoice ke PDF
-   Status pembayaran (Lunas / Belum Lunas)

## Requirements

-   PHP >= 8.2
-   Composer
-   MySQL / MariaDB / PostgreSQL
-   Node.js >= 18.x
-   NPM / Yarn
-   Web server (Apache / Nginx)

## Instalasi

```bash
git clone https://github.com/yodh222/Infinindotech-Technical-Test.git
cd Infinindotech-Technical-Test
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

```

## Userpass

Digunakan untuk login di Aplikasi.

-   Username : `admin@gmail.com`
-   Password : `Admin123`
