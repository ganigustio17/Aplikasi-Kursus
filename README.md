Cara Menjalankan Project Laravel


1. Clone repository
Jalankan perintah: git clone nama-repo-github

2. Masuk ke folder project
Ketik: cd ./nama-folder-project/

3. Buka project di editor
Jika menggunakan Visual Studio Code, ketik: code .

4. Install dependency dengan Composer
Ketik: composer install
Jika composer install gagal, coba:
composer update lalu composer install
Jika tetap gagal, gunakan:
composer update --no-cache lalu composer install --no-cache

5. Buat database di MySQL
Buka MySQL atau phpMyAdmin.
Buat database baru sesuai keinginan Anda.

6. Impor file SQL ke database
Buka file db-dump.sql di folder project.
Tekan Ctrl + A untuk memilih semua, lalu Ctrl + C untuk menyalin.
Pergi ke tab SQL di database yang sudah dibuat, lalu tekan Ctrl + V untuk menempelkan isi file.
Klik tombol Go.

7. Salin file .env
Ketik: cp .env.example .env

8. Atur konfigurasi database di file .env
Buka file .env.
Cari bagian berikut dan sesuaikan:
DB_DATABASE=nama_database
DB_USERNAME=nama_user
DB_PASSWORD=password

9. Generate Application Key
Ketik: php artisan key:generate

10. Jalankan server Laravel
Ketik: php artisan serve

11. Di terminal
ketik : php artisan tinker

12. Lalu
ketik : echo bcrypt('nama_password_baru')

13. Salin hashing password tersebut dengan ctrl + c

14. Lalu pergi ke table users di database lalu pada data table users dengan id 1 tersebut klik edit lalu pada bagian password ganti password lama dengan hashing password yang baru di salin tadi dengan ctrl + a lalu ctrl + v

15. Lalu pada laman login, login dengan data tersebut.
