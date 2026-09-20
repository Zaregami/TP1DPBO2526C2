#include <iostream>
#include <string>

using namespace std;

// class film untuk data film
class Film {
private:
    // atribut film
    string id;
    string judul;
    string genre;
    int durasi;
    int hargaTiket;

public:
    // konstruktor kosong
    Film() {
        this->id = "";
        this->judul = "";
        this->genre = "";
        this->durasi = 0;
        this->hargaTiket = 0;
    }

    // konstruktor dengan parameter
    Film(string id, string judul, string genre, int durasi, int hargaTiket) {
        this->id = id;
        this->judul = judul;
        this->genre = genre;
        this->durasi = durasi;
        this->hargaTiket = hargaTiket;
    }

    // getter dan setter id
    string getId() {
        return this->id;
    }
    void setId(string id) {
        this->id = id;
    }

    // getter dan setter judul
    string getJudul() {
        return this->judul;
    }
    void setJudul(string judul) {
        this->judul = judul;
    }

    // getter dan setter genre
    string getGenre() {
        return this->genre;
    }
    void setGenre(string genre) {
        this->genre = genre;
    }

    // getter dan setter durasi
    int getDurasi() {
        return this->durasi;
    }
    void setDurasi(int durasi) {
        this->durasi = durasi;
    }

    // getter dan setter harga tiket
    int getHargaTiket() {
        return this->hargaTiket;
    }
    void setHargaTiket(int hargaTiket) {
        this->hargaTiket = hargaTiket;
    }

    // destruktor
    ~Film() {
    }
};
