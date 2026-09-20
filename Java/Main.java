import java.util.ArrayList;
import java.util.Scanner;

public class Main {

    // fungsi cari index film berdasarkan id
    public static int cariIndexFilm(ArrayList<Film> daftarFilm, String id) {
        for (int i = 0; i < daftarFilm.size(); i++) {
            if (daftarFilm.get(i).getId().equalsIgnoreCase(id)) {
                return i;
            }
        }
        return -1;
    }

    // fungsi tampilkan semua film
    public static void tampilkanFilm(ArrayList<Film> daftarFilm) {
        if (daftarFilm.isEmpty()) {
            System.out.println("data film kosong");
            return;
        }

        System.out.println("\n--- daftar film bioskop ---");
        for (int i = 0; i < daftarFilm.size(); i++) {
            System.out.println((i + 1) + ". "
                    + "id: " + daftarFilm.get(i).getId() + " | "
                    + "judul: " + daftarFilm.get(i).getJudul() + " | "
                    + "genre: " + daftarFilm.get(i).getGenre() + " | "
                    + "durasi: " + daftarFilm.get(i).getDurasi() + " menit | "
                    + "harga: rp " + daftarFilm.get(i).getHargaTiket());
        }
        System.out.println("total film: " + daftarFilm.size());
    }

    // fungsi tambah film
    public static void tambahFilm(ArrayList<Film> daftarFilm, Scanner scanner) {
        System.out.println("\n--- tambah film ---");
        System.out.print("masukkan id: ");
        String id = scanner.nextLine();

        // cek id unik
        if (cariIndexFilm(daftarFilm, id) != -1) {
            System.out.println("gagal, id film sudah ada");
            return;
        }

        System.out.print("masukkan judul: ");
        String judul = scanner.nextLine();
        System.out.print("masukkan genre: ");
        String genre = scanner.nextLine();
        System.out.print("masukkan durasi (menit): ");
        int durasi = scanner.nextInt();
        System.out.print("masukkan harga tiket (rp): ");
        int hargaTiket = scanner.nextInt();
        scanner.nextLine(); // membersihkan buffer

        // buat objek baru dan simpan ke list
        Film filmBaru = new Film(id, judul, genre, durasi, hargaTiket);
        daftarFilm.add(filmBaru);

        System.out.println("berhasil menambah film");
    }

    // fungsi update film
    public static void updateFilm(ArrayList<Film> daftarFilm, Scanner scanner) {
        if (daftarFilm.isEmpty()) {
            System.out.println("data film kosong");
            return;
        }

        System.out.println("\n--- update film ---");
        System.out.print("masukkan id film yang mau diubah: ");
        String id = scanner.nextLine();

        int idx = cariIndexFilm(daftarFilm, id);
        if (idx == -1) {
            System.out.println("film tidak ditemukan");
            return;
        }

        System.out.print("masukkan judul baru: ");
        String judulBaru = scanner.nextLine();
        System.out.print("masukkan genre baru: ");
        String genreBaru = scanner.nextLine();
        System.out.print("masukkan durasi baru: ");
        int durasiBaru = scanner.nextInt();
        System.out.print("masukkan harga tiket baru: ");
        int hargaBaru = scanner.nextInt();
        scanner.nextLine(); // membersihkan buffer

        // update atribut objek
        daftarFilm.get(idx).setJudul(judulBaru);
        daftarFilm.get(idx).setGenre(genreBaru);
        daftarFilm.get(idx).setDurasi(durasiBaru);
        daftarFilm.get(idx).setHargaTiket(hargaBaru);

        System.out.println("berhasil update film");
    }

    // fungsi hapus film
    public static void hapusFilm(ArrayList<Film> daftarFilm, Scanner scanner) {
        if (daftarFilm.isEmpty()) {
            System.out.println("data film kosong");
            return;
        }

        System.out.println("\n--- hapus film ---");
        System.out.print("masukkan id film yang mau dihapus: ");
        String id = scanner.nextLine();

        int idx = cariIndexFilm(daftarFilm, id);
        if (idx == -1) {
            System.out.println("film tidak ditemukan");
            return;
        }

        daftarFilm.remove(idx);
        System.out.println("berhasil hapus film");
    }

    // fungsi cari film
    public static void cariFilm(ArrayList<Film> daftarFilm, Scanner scanner) {
        if (daftarFilm.isEmpty()) {
            System.out.println("data film kosong");
            return;
        }

        System.out.println("\n--- cari film ---");
        System.out.print("masukkan id atau judul yang dicari: ");
        String keyword = scanner.nextLine().toLowerCase();

        boolean ditemukan = false;
        System.out.println("\nhasil pencarian:");
        for (int i = 0; i < daftarFilm.size(); i++) {
            Film f = daftarFilm.get(i);
            if (f.getId().toLowerCase().contains(keyword) || f.getJudul().toLowerCase().contains(keyword)) {
                System.out.println("- "
                        + "id: " + f.getId() + " | "
                        + "judul: " + f.getJudul() + " | "
                        + "genre: " + f.getGenre() + " | "
                        + "durasi: " + f.getDurasi() + " menit | "
                        + "harga: rp " + f.getHargaTiket());
                ditemukan = true;
            }
        }

        if (!ditemukan) {
            System.out.println("film tidak ditemukan");
        }
    }

    public static void main(String[] args) {
        // list data film
        ArrayList<Film> daftarFilm = new ArrayList<>();

        // data awal
        daftarFilm.add(new Film("F01", "Interstellar", "Sci-Fi", 169, 50000));
        daftarFilm.add(new Film("F02", "Steins;Gate: Fuka Ryouiki no Déjà vu", "Sci-Fi", 90, 45000));
        daftarFilm.add(new Film("F03", "Project Hail Mary", "Sci-Fi", 135, 55000));

        Scanner scanner = new Scanner(System.in);
        int pilihan = 0;

        // menu utama
        do {
            System.out.println("\n=== bioskop (java) ===");
            System.out.println("1. tampilkan film");
            System.out.println("2. tambah film");
            System.out.println("3. update film");
            System.out.println("4. hapus film");
            System.out.println("5. cari film");
            System.out.println("6. keluar");
            System.out.print("pilih menu: ");
            pilihan = scanner.nextInt();
            scanner.nextLine(); // membersihkan buffer

            switch (pilihan) {
                case 1:
                    tampilkanFilm(daftarFilm);
                    break;
                case 2:
                    tambahFilm(daftarFilm, scanner);
                    break;
                case 3:
                    updateFilm(daftarFilm, scanner);
                    break;
                case 4:
                    hapusFilm(daftarFilm, scanner);
                    break;
                case 5:
                    cariFilm(daftarFilm, scanner);
                    break;
                case 6:
                    System.out.println("keluar dari program");
                    break;
                default:
                    System.out.println("pilihan tidak valid");
                    break;
            }
        } while (pilihan != 6);

        scanner.close();
    }
}
