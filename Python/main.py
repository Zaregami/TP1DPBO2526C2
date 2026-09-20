from Film import Film

# fungsi cari index film berdasarkan id
def cariIndexFilm(daftarFilm, id):
    for i in range(len(daftarFilm)):
        if daftarFilm[i].getId().lower() == id.lower():
            return i
    return -1

# fungsi tampilkan semua film
def tampilkanFilm(daftarFilm):
    if len(daftarFilm) == 0:
        print("data film kosong")
        return

    print("\n--- daftar film bioskop ---")
    for i in range(len(daftarFilm)):
        print(f"{i + 1}. id: {daftarFilm[i].getId()} | judul: {daftarFilm[i].getJudul()} | genre: {daftarFilm[i].getGenre()} | durasi: {daftarFilm[i].getDurasi()} menit | harga: rp {daftarFilm[i].getHargaTiket()}")
    print("total film:", len(daftarFilm))

# fungsi tambah film
def tambahFilm(daftarFilm):
    print("\n--- tambah film ---")
    id = input("masukkan id: ")

    # cek id unik
    if cariIndexFilm(daftarFilm, id) != -1:
        print("gagal, id film sudah ada")
        return

    judul = input("masukkan judul: ")
    genre = input("masukkan genre: ")
    durasi = int(input("masukkan durasi (menit): "))
    hargaTiket = int(input("masukkan harga tiket (rp): "))

    # buat objek baru dan simpan ke list
    filmBaru = Film(id, judul, genre, durasi, hargaTiket)
    daftarFilm.append(filmBaru)

    print("berhasil menambah film")

# fungsi update film
def updateFilm(daftarFilm):
    if len(daftarFilm) == 0:
        print("data film kosong")
        return

    print("\n--- update film ---")
    id = input("masukkan id film yang mau diubah: ")

    idx = cariIndexFilm(daftarFilm, id)
    if idx == -1:
        print("film tidak ditemukan")
        return

    judulBaru = input("masukkan judul baru: ")
    genreBaru = input("masukkan genre baru: ")
    durasiBaru = int(input("masukkan durasi baru: "))
    hargaBaru = int(input("masukkan harga tiket baru: "))

    # update atribut objek
    daftarFilm[idx].setJudul(judulBaru)
    daftarFilm[idx].setGenre(genreBaru)
    daftarFilm[idx].setDurasi(durasiBaru)
    daftarFilm[idx].setHargaTiket(hargaBaru)

    print("berhasil update film")

# fungsi hapus film
def hapusFilm(daftarFilm):
    if len(daftarFilm) == 0:
        print("data film kosong")
        return

    print("\n--- hapus film ---")
    id = input("masukkan id film yang mau dihapus: ")

    idx = cariIndexFilm(daftarFilm, id)
    if idx == -1:
        print("film tidak ditemukan")
        return

    del daftarFilm[idx]
    print("berhasil hapus film")

# fungsi cari film
def cariFilm(daftarFilm):
    if len(daftarFilm) == 0:
        print("data film kosong")
        return

    print("\n--- cari film ---")
    keyword = input("masukkan id atau judul yang dicari: ").lower()

    ditemukan = False
    print("\nhasil pencarian:")
    for i in range(len(daftarFilm)):
        if keyword in daftarFilm[i].getId().lower() or keyword in daftarFilm[i].getJudul().lower():
            print(f"- id: {daftarFilm[i].getId()} | judul: {daftarFilm[i].getJudul()} | genre: {daftarFilm[i].getGenre()} | durasi: {daftarFilm[i].getDurasi()} menit | harga: rp {daftarFilm[i].getHargaTiket()}")
            ditemukan = True

    if not ditemukan:
        print("film tidak ditemukan")

def main():
    # list data film
    daftarFilm = [
        Film("F01", "Interstellar", "Sci-Fi", 169, 50000),
        Film("F02", "Steins;Gate: Fuka Ryouiki no Déjà vu", "Sci-Fi", 90, 45000),
        Film("F03", "Project Hail Mary", "Sci-Fi", 135, 55000)
    ]

    pilihan = 0

    # menu utama
    while True:
        print("\n=== bioskop (python) ===")
        print("1. tampilkan film")
        print("2. tambah film")
        print("3. update film")
        print("4. hapus film")
        print("5. cari film")
        print("6. keluar")
        pilihan = int(input("pilih menu: "))

        if pilihan == 1:
            tampilkanFilm(daftarFilm)
        elif pilihan == 2:
            tambahFilm(daftarFilm)
        elif pilihan == 3:
            updateFilm(daftarFilm)
        elif pilihan == 4:
            hapusFilm(daftarFilm)
        elif pilihan == 5:
            cariFilm(daftarFilm)
        elif pilihan == 6:
            print("keluar dari program")
            break
        else:
            print("pilihan tidak valid")

if __name__ == "__main__":
    main()
