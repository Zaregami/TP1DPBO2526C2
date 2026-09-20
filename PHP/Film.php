<?php

// class film untuk data film
class Film {
    // atribut film
    private string $id;
    private string $judul;
    private string $genre;
    private int $durasi;
    private int $hargaTiket;
    private string $gambar;

    // konstruktor dengan parameter
    public function __construct(string $id = "", string $judul = "", string $genre = "", int $durasi = 0, int $hargaTiket = 0, string $gambar = "") {
        $this->id = $id;
        $this->judul = $judul;
        $this->genre = $genre;
        $this->durasi = $durasi;
        $this->hargaTiket = $hargaTiket;
        $this->gambar = $gambar;
    }

    // getter dan setter id
    public function getId(): string {
        return $this->id;
    }
    public function setId(string $id): void {
        $this->id = $id;
    }

    // getter dan setter judul
    public function getJudul(): string {
        return $this->judul;
    }
    public function setJudul(string $judul): void {
        $this->judul = $judul;
    }

    // getter dan setter genre
    public function getGenre(): string {
        return $this->genre;
    }
    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    // getter dan setter durasi
    public function getDurasi(): int {
        return $this->durasi;
    }
    public function setDurasi(int $durasi): void {
        $this->durasi = $durasi;
    }

    // getter dan setter harga tiket
    public function getHargaTiket(): int {
        return $this->hargaTiket;
    }
    public function setHargaTiket(int $hargaTiket): void {
        $this->hargaTiket = $hargaTiket;
    }

    // getter dan setter gambar
    public function getGambar(): string {
        return $this->gambar;
    }
    public function setGambar(string $gambar): void {
        $this->gambar = $gambar;
    }
}
?>
