# SalesManager - Aplikasi Kasir (POS) Modern dengan Laravel & Livewire

Halo! Kenalin, ini SalesManager, sebuah aplikasi kasir (Point of Sale) yang saya bangun dari nol pake TALL Stack. Berawal dari sebuah skema database, saya pengen coba bikin aplikasi yang gak cuma jalan, tapi juga modern, interaktif, dan enak dipake sama kasirnya.

Di proyek ini saya belajar banyak banget, terutama soal gimana caranya bikin halaman yang dinamis pake Livewire biar user gak perlu bolak-balik nge-refresh halaman.

![Tampilan Aplikasi SalesManager](https://github.com/user-attachments/assets/babc8bfb-f9f7-4575-a630-20965fcbc094)

---

## ✨ Fitur Keren di Dalamnya

-   [x] **Dashboard Informatif**: Langsung liat ringkasan pendapatan hari ini dan produk apa aja yang paling laku.
-   [x] **Manajemen Data Master**: CRUD (Create, Read, Update, Delete) lengkap buat Produk, Kategori, Pelanggan, dan User.
-   [x] **Halaman Kasir (POS) Interaktif**: Gak perlu refresh! Tambah barang ke keranjang, cari produk, diskon, sampe total belanja semuanya diupdate secara real-time pake **Livewire**.
-   [x] **Diskon Persentase**: Kasir bisa dengan gampang masukin diskon dalam bentuk persen (%).
-   [x] **Simulasi Pembayaran QRIS**: Alur pembayaran modern yang nampilin modal dengan QR Code dinamis.
-   [x] **Riwayat Penjualan**: Liat daftar semua transaksi yang pernah terjadi dan cek detailnya sampe ke produk-produk yang dibeli.

---

## 💻 Teknologi yang Saya Pakai

Proyek ini dibangun di atas fondasi teknologi yang modern dan powerful:

-   **Backend**: Laravel
-   **Frontend**: Tailwind CSS & Livewire (TALL Stack)
-   **Database**: MySQL

---

## 🛠️ Mau Coba Jalanin di Laptopmu?

Gampang kok, ikutin aja langkah-langkah ini:

1.  **Clone repository ini**
    ```bash
    git clone [https://github.com/kandarlubis/SalesManager.git](https://github.com/kandarlubis/SalesManager.git)
    cd SalesManager
    ```

2.  **Install semua dependency-nya**
    ```bash
    composer install
    ```

3.  **Siapin file `.env` kamu**
    ```bash
    cp .env.example .env
    ```
    Jangan lupa sesuaikan settingan database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) di file `.env` yang baru.

4.  **Generate `APP_KEY`**
    ```bash
    php artisan key:generate
    ```

5.  **Jalanin migrasi & isi data awal**
    Ini perintah sakti buat ngebersihin, ngebangun, dan ngisi database kamu sekaligus.
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Nyalain servernya!**
    ```bash
    php artisan serve
    ```

Selesai! Sekarang buka `http://127.0.0.1:8000` di browser dan aplikasi kasirnya siap dipake.

---

Makasih udah mampir! Proyek ini jadi tempat saya belajar banyak banget soal arsitektur aplikasi web modern. Kalo ada masukan atau pertanyaan, jangan ragu buat kontak ya.
