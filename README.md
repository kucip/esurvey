<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup Di Local

Jangan lupa import dulu databasenya setelah itu bisa lanjut step dibawah. Next:

- Clone project :
```bash
git clone https://github.com/kucip/bixboxgames.git
```
- jalankan perintah :
```bash
composer install
```
- buat file  <b>.env</b>  duplicat file  <b>.env.example</b>  jangan lupa rename jadi  <b>.env</b>
- buka file  <b>.env</b>  Rubah di bagian (Connection ke database kita):

```bash
DB_DATABASE=nama-database
DB_USERNAME=username-db
DB_PASSWORD=password-db
```

- jalankan perintah (Generate Key):
```bash
php artisan key:generate
```
- jalankan perintah (Fresh Migrasi dan Seeding tabel):
(<i>Jika ada perlu menambahkan seed atau migrasi silahkan ditambahakan</i>)

```bash
php artisan migrate:fresh --seed
```
- Done

## Menjalankan Aplikasi

```bash
php artisan serve
```

## Account Administrator Default
- Administrator Utama : kode 1

```bash
email : admin@optima.com
password : 1234
```

- Administrator Umum : kode 2

```bash
email : user@optima.com
password : 1234
```
