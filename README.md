# Tugas Praktikum 1 (TP1) - Desain dan Pemrograman Berorientasi Objek

## Janji
> Saya Reza dengan NIM 2507880 mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---

## Penjelasan Desain dan Alur Kode

### 1. Desain Program & Konsep OOP
Program ini dibuat untuk mengelola data film di bioskop menggunakan 1 class utama yaitu `Film`. Prinsip OOP yang diterapkan adalah **Encapsulation**:
- Seluruh atribut bersifat `private` sehingga tidak dapat diakses langsung dari luar class.
- Nilai atribut diakses dan diubah secara aman melalui method `getter` dan `setter`.
- Terdapat konstruktor untuk menginisialisasi objek saat dibuat (konstruktor kosong dan berparameter).

#### Atribut Class `Film`:
- `id`: kode unik untuk setiap film.
- `judul`: nama/judul film bioskop.
- `genre`: kategori/genre film.
- `durasi`: durasi tayang film (dalam menit).
- `hargaTiket`: harga tiket penonton (dalam rupiah).
- `gambar` *(khusus PHP)*: path lokasi file poster gambar lokal di dalam folder `assets/`.

#### Struktur Data Penyimpanan:
Objek-objek film disimpan ke dalam struktur *array / list of object*:
- **C++**: `vector<Film> daftarFilm`
- **Java**: `ArrayList<Film> daftarFilm`
- **Python**: `list` `daftarFilm`
- **PHP**: `array` `$_SESSION['daftarFilm']` (disimpan dalam session agar data tidak hilang saat refresh halaman, tanpa menggunakan database).

---

### 2. Alur Program (Flow of Code)

1. **Inisialisasi Data Awal**:
   Saat program pertama kali dijalankan, sudah disiapkan 3 data film awal (Interstellar, Steins;Gate: Fuka Ryouiki no Déjà vu, Project Hail Mary).

2. **Antarmuka & Menu Utama**:
   - Pada **C++, Java, dan Python (CLI)**: Program menjalankan perulangan menu (1 sampai 6) di terminal:
     1. Tampilkan film
     2. Tambah film
     3. Update film
     4. Hapus film
     5. Cari film
     6. Keluar
   - Pada **PHP (Web)**: Menggunakan form HTML untuk input/edit data, tombol aksi (edit/hapus), form pencarian, dan tabel HTML untuk menampilkan katalog film beserta gambar lokalnya.

3. **Logika Fitur (CRUD & Cari)**:
   - **Tampilkan Film**: Melakukan perulangan pada list `daftarFilm` dan menampilkan detail setiap film (ID, judul, genre, durasi, harga tiket).
   - **Tambah Film**: Menerima input data baru, memeriksa apakah ID sudah terdaftar sebelumnya melalui fungsi `cariIndexFilm`. Jika ID belum ada, membuat objek `Film` baru dan memasukkannya ke dalam list.
   - **Update Film**: Mencari indeks film berdasarkan ID yang dimasukkan. Jika ditemukan, data objek diperbarui menggunakan method `setter`.
   - **Hapus Film**: Mencari indeks film berdasarkan ID, lalu menghapus elemen dari list.
   - **Cari Film**: Memeriksa kecocokan kata kunci pencarian dengan ID atau judul film yang tersimpan di dalam list.


dokumentasi

php
https://drive.google.com/file/d/1spN0lu4z7tZgBVG1ew-MTYbQ2TvzSnYB/view?usp=sharing
