# DesaDigital v2

Platform digital desa terintegrasi dengan fitur profil desa, demografi, berita, pelayanan administrasi, peta interaktif, dan pasar desa/UMKM.

🌐 **Live:** [desadigital.novasistem.cloud](https://desadigital.novasistem.cloud)

## Fitur

- **Profil Desa** — Informasi desa, visi misi, sejarah
- **Demografi** — Data penduduk dan statistik
- **Berita & Pengumuman** — Manajemen berita desa
- **Pelayanan** — Surat menyurat online
- **Peta Interaktif** — Peta wilayah desa
- **Pasar Desa** — UMKM dan produk lokal
- **Admin Panel** — Manajemen konten dengan role-based access
- **Autentikasi Multi-Level** — Admin, Operator, Warga

## Teknologi

- Laravel 11
- MySQL
- Tailwind CSS
- Alpine.js / Vue.js
- Docker
- Nginx

## Instalasi

```bash
git clone https://github.com/MuhamadGilangFikriAzi/desadigital-v2.git
cd desadigital-v2

# Build dengan Docker
docker compose up -d

# Migrasi database
docker compose exec laravel php artisan migrate
docker compose exec laravel php artisan db:seed

# Akses: http://localhost:8080
```

## Persyaratan Sistem

- Docker & Docker Compose
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js & NPM

## Struktur

```
desadigital-v2/
├── laravel/
│   ├── app/
│   ├── resources/views/
│   ├── routes/
│   └── database/
├── docker-compose.yml
├── Dockerfile
└── nginx.conf
```
