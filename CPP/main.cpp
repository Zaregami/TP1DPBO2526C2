#include <iostream>
#include <vector>
#include <string>
#include "Film.cpp"

using namespace std;

// fungsi cari index film berdasarkan id
int cariIndexFilm(vector<Film> daftarFilm, string id) {
    for (int i = 0; i < daftarFilm.size(); i++) {
        if (daftarFilm[i].getId() == id) {
            return i;
        }
    }
    return -1;
}

// fungsi tampilkan semua film
void tampilkanFilm(vector<Film> daftarFilm) {
    if (daftarFilm.empty()) {
        cout << "data film kosong" << endl;
        return;
    }

    cout << "\n--- daftar film bioskop ---" << endl;
    for (int i = 0; i < daftarFilm.size(); i++) {
        cout << (i + 1) << ". "
             << "id: " << daftarFilm[i].getId() << " | "
             << "judul: " << daftarFilm[i].getJudul() << " | "
             << "genre: " << daftarFilm[i].getGenre() << " | "
             << "durasi: " << daftarFilm[i].getDurasi() << " menit | "
             << "harga: rp " << daftarFilm[i].getHargaTiket() << endl;
    }
    cout << "total film: " << daftarFilm.size() << endl;
}

// fungsi tambah film
void tambahFilm(vector<Film> &daftarFilm) {
    string id, judul, genre;
    int durasi, hargaTiket;

    cout << "\n--- tambah film ---" << endl;
    cout << "masukkan id: ";
    cin >> id;

    // cek id unik
    if (cariIndexFilm(daftarFilm, id) != -1) {
        cout << "gagal, id film sudah ada" << endl;
        return;
    }

    cin.ignore();
    cout << "masukkan judul: ";
    getline(cin, judul);
    cout << "masukkan genre: ";
    getline(cin, genre);
    cout << "masukkan durasi (menit): ";
    cin >> durasi;
    cout << "masukkan harga tiket (rp): ";
    cin >> hargaTiket;

    // buat objek baru dan simpan ke list
    Film filmBaru(id, judul, genre, durasi, hargaTiket);
    daftarFilm.push_back(filmBaru);

    cout << "berhasil menambah film" << endl;
}

// fungsi update film
void updateFilm(vector<Film> &daftarFilm) {
    if (daftarFilm.empty()) {
        cout << "data film kosong" << endl;
        return;
    }

    string id;
    cout << "\n--- update film ---" << endl;
    cout << "masukkan id film yang mau diubah: ";
    cin >> id;

    int idx = cariIndexFilm(daftarFilm, id);
    if (idx == -1) {
        cout << "film tidak ditemukan" << endl;
        return;
    }

    string judulBaru, genreBaru;
    int durasiBaru, hargaBaru;

    cin.ignore();
    cout << "masukkan judul baru: ";
    getline(cin, judulBaru);
    cout << "masukkan genre baru: ";
    getline(cin, genreBaru);
    cout << "masukkan durasi baru: ";
    cin >> durasiBaru;
    cout << "masukkan harga tiket baru: ";
    cin >> hargaBaru;

    // update atribut objek
    daftarFilm[idx].setJudul(judulBaru);
    daftarFilm[idx].setGenre(genreBaru);
    daftarFilm[idx].setDurasi(durasiBaru);
    daftarFilm[idx].setHargaTiket(hargaBaru);

    cout << "berhasil update film" << endl;
}

// fungsi hapus film
void hapusFilm(vector<Film> &daftarFilm) {
    if (daftarFilm.empty()) {
        cout << "data film kosong" << endl;
        return;
    }

    string id;
    cout << "\n--- hapus film ---" << endl;
    cout << "masukkan id film yang mau dihapus: ";
    cin >> id;

    int idx = cariIndexFilm(daftarFilm, id);
    if (idx == -1) {
        cout << "film tidak ditemukan" << endl;
        return;
    }

    daftarFilm.erase(daftarFilm.begin() + idx);
    cout << "berhasil hapus film" << endl;
}

// fungsi cari film
void cariFilm(vector<Film> daftarFilm) {
    if (daftarFilm.empty()) {
        cout << "data film kosong" << endl;
        return;
    }

    string keyword;
    cin.ignore();
    cout << "\n--- cari film ---" << endl;
    cout << "masukkan id atau judul yang dicari: ";
    getline(cin, keyword);

    bool ditemukan = false;
    cout << "\nhasil pencarian:" << endl;
    for (int i = 0; i < daftarFilm.size(); i++) {
        if (daftarFilm[i].getId() == keyword || daftarFilm[i].getJudul().find(keyword) != string::npos) {
            cout << "- "
                 << "id: " << daftarFilm[i].getId() << " | "
                 << "judul: " << daftarFilm[i].getJudul() << " | "
                 << "genre: " << daftarFilm[i].getGenre() << " | "
                 << "durasi: " << daftarFilm[i].getDurasi() << " menit | "
                 << "harga: rp " << daftarFilm[i].getHargaTiket() << endl;
            ditemukan = true;
        }
    }

    if (!ditemukan) {
        cout << "film tidak ditemukan" << endl;
    }
}

int main() {
    // list data film
    vector<Film> daftarFilm;

    // data awal
    daftarFilm.push_back(Film("F01", "Interstellar", "Sci-Fi", 169, 50000));
    daftarFilm.push_back(Film("F02", "Steins;Gate: Fuka Ryouiki no Déjà vu", "Sci-Fi", 90, 45000));
    daftarFilm.push_back(Film("F03", "Project Hail Mary", "Sci-Fi", 135, 55000));

    int pilihan = 0;

    // menu utama
    do {
        cout << "\n=== bioskop (cpp) ===" << endl;
        cout << "1. tampilkan film" << endl;
        cout << "2. tambah film" << endl;
        cout << "3. update film" << endl;
        cout << "4. hapus film" << endl;
        cout << "5. cari film" << endl;
        cout << "6. keluar" << endl;
        cout << "pilih menu: ";
        cin >> pilihan;

        switch (pilihan) {
            case 1:
                tampilkanFilm(daftarFilm);
                break;
            case 2:
                tambahFilm(daftarFilm);
                break;
            case 3:
                updateFilm(daftarFilm);
                break;
            case 4:
                hapusFilm(daftarFilm);
                break;
            case 5:
                cariFilm(daftarFilm);
                break;
            case 6:
                cout << "keluar dari program" << endl;
                break;
            default:
                cout << "pilihan tidak valid" << endl;
                break;
        }
    } while (pilihan != 6);

    return 0;
}
