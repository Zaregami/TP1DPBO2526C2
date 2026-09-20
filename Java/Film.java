// class film untuk data film
public class Film {
    // atribut film
    private String id;
    private String judul;
    private String genre;
    private int durasi;
    private int hargaTiket;

    // konstruktor kosong
    public Film() {
        this.id = "";
        this.judul = "";
        this.genre = "";
        this.durasi = 0;
        this.hargaTiket = 0;
    }

    // konstruktor dengan parameter
    public Film(String id, String judul, String genre, int durasi, int hargaTiket) {
        this.id = id;
        this.judul = judul;
        this.genre = genre;
        this.durasi = durasi;
        this.hargaTiket = hargaTiket;
    }

    // getter dan setter id
    public String getId() {
        return this.id;
    }
    public void setId(String id) {
        this.id = id;
    }

    // getter dan setter judul
    public String getJudul() {
        return this.judul;
    }
    public void setJudul(String judul) {
        this.judul = judul;
    }

    // getter dan setter genre
    public String getGenre() {
        return this.genre;
    }
    public void setGenre(String genre) {
        this.genre = genre;
    }

    // getter dan setter durasi
    public int getDurasi() {
        return this.durasi;
    }
    public void setDurasi(int durasi) {
        this.durasi = durasi;
    }

    // getter dan setter harga tiket
    public int getHargaTiket() {
        return this.hargaTiket;
    }
    public void setHargaTiket(int hargaTiket) {
        this.hargaTiket = hargaTiket;
    }
}
