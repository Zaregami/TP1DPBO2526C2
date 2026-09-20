<?php
require_once __DIR__ . "/Film.php";
session_start();

// inisialisasi data awal (otomatis reset jika masih tersimpan data lama)
if (!isset($_SESSION['daftarFilm']) || isset($_GET['reset']) || (isset($_SESSION['daftarFilm'][1]) && $_SESSION['daftarFilm'][1]->getJudul() === 'Spirited Away')) {
    // data awal
    $_SESSION['daftarFilm'] = [
        new Film("F01", "Interstellar", "Sci-Fi", 169, 50000, "assets/interstellar.jpg"),
        new Film("F02", "Steins;Gate: Fuka Ryouiki no Déjà vu", "Sci-Fi", 90, 45000, "assets/steins_gate.jpg"),
        new Film("F03", "Project Hail Mary", "Sci-Fi", 135, 55000, "assets/project_hail_mary.jpg")
    ];
}

// fungsi cari index film berdasarkan id
function cariIndexFilm($daftarFilm, $id) {
    for ($i = 0; $i < count($daftarFilm); $i++) {
        if (strtolower($daftarFilm[$i]->getId()) === strtolower($id)) {
            return $i;
        }
    }
    return -1;
}

$pesan = "";

// fungsi hapus film
if (isset($_GET['aksi']) && $_GET['aksi'] === 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $idx = cariIndexFilm($_SESSION['daftarFilm'], $id);
    if ($idx != -1) {
        array_splice($_SESSION['daftarFilm'], $idx, 1);
        $pesan = "berhasil hapus film";
    } else {
        $pesan = "film tidak ditemukan";
    }
}

// form tambah dan update
$modeEdit = false;
$filmEdit = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode = $_POST['mode'];
    $id = trim($_POST['id']);
    $judul = trim($_POST['judul']);
    $genre = trim($_POST['genre']);
    $durasi = (int)$_POST['durasi'];
    $hargaTiket = (int)$_POST['hargaTiket'];

    $gambar = "";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $namaFile = time() . "_" . basename($_FILES['gambar']['name']);
        $tujuan = __DIR__ . "/assets/" . $namaFile;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
            $gambar = "assets/" . $namaFile;
        }
    }

    // fungsi tambah film
    if ($mode === 'tambah') {
        // cek id unik
        if (cariIndexFilm($_SESSION['daftarFilm'], $id) != -1) {
            $pesan = "gagal, id film sudah ada";
        } else {
            // buat objek baru dan simpan ke list
            $filmBaru = new Film($id, $judul, $genre, $durasi, $hargaTiket, $gambar);
            $_SESSION['daftarFilm'][] = $filmBaru;
            $pesan = "berhasil menambah film";
        }
    } 
    // fungsi update film
    elseif ($mode === 'update') {
        $idx = cariIndexFilm($_SESSION['daftarFilm'], $id);
        if ($idx != -1) {
            // update atribut objek
            $_SESSION['daftarFilm'][$idx]->setJudul($judul);
            $_SESSION['daftarFilm'][$idx]->setGenre($genre);
            $_SESSION['daftarFilm'][$idx]->setDurasi($durasi);
            $_SESSION['daftarFilm'][$idx]->setHargaTiket($hargaTiket);
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
                $_SESSION['daftarFilm'][$idx]->setGambar($gambar);
            }
            $pesan = "berhasil update film";
        } else {
            $pesan = "film tidak ditemukan";
        }
    }
}

// mode edit
if (isset($_GET['aksi']) && $_GET['aksi'] === 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $idx = cariIndexFilm($_SESSION['daftarFilm'], $id);
    if ($idx != -1) {
        $filmEdit = $_SESSION['daftarFilm'][$idx];
        $modeEdit = true;
    }
}

// fungsi cari film
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
$daftarFilm = [];

if ($keyword !== "") {
    for ($i = 0; $i < count($_SESSION['daftarFilm']); $i++) {
        $f = $_SESSION['daftarFilm'][$i];
        if (stripos($f->getId(), $keyword) !== false || stripos($f->getJudul(), $keyword) !== false) {
            $daftarFilm[] = $f;
        }
    }
} else {
    // fungsi tampilkan semua film
    $daftarFilm = $_SESSION['daftarFilm'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>bioskop (php)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #999;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .pesan {
            background: #eef;
            padding: 8px;
            margin-bottom: 12px;
            border-left: 4px solid #33c;
        }
        .form-group {
            margin-bottom: 8px;
        }
        .form-group label {
            display: inline-block;
            width: 160px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>bioskop (php)</h2>

    <?php if (!empty($pesan)): ?>
        <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <!-- form tambah atau update -->
    <h3><?= $modeEdit ? "update film" : "tambah film" ?></h3>
    <form method="POST" action="index.php" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="<?= $modeEdit ? 'update' : 'tambah' ?>">

        <div class="form-group">
            <label>id:</label>
            <input type="text" name="id" required value="<?= $modeEdit ? htmlspecialchars($filmEdit->getId()) : '' ?>" <?= $modeEdit ? 'readonly' : '' ?>>
        </div>
        <div class="form-group">
            <label>judul:</label>
            <input type="text" name="judul" required value="<?= $modeEdit ? htmlspecialchars($filmEdit->getJudul()) : '' ?>">
        </div>
        <div class="form-group">
            <label>genre:</label>
            <input type="text" name="genre" required value="<?= $modeEdit ? htmlspecialchars($filmEdit->getGenre()) : '' ?>">
        </div>
        <div class="form-group">
            <label>durasi (menit):</label>
            <input type="number" name="durasi" required value="<?= $modeEdit ? htmlspecialchars((string)$filmEdit->getDurasi()) : '' ?>">
        </div>
        <div class="form-group">
            <label>harga tiket (rp):</label>
            <input type="number" name="hargaTiket" required value="<?= $modeEdit ? htmlspecialchars((string)$filmEdit->getHargaTiket()) : '' ?>">
        </div>
        <div class="form-group">
            <label>poster (lokal):</label>
            <input type="file" name="gambar" accept="image/*">
        </div>
        <button type="submit"><?= $modeEdit ? "simpan perubahan" : "tambah film" ?></button>
        <?php if ($modeEdit): ?>
            <a href="index.php">batal</a>
        <?php endif; ?>
    </form>

    <hr style="margin: 20px 0;">

    <!-- form cari -->
    <h3>daftar film</h3>
    <form method="GET" action="index.php">
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="cari id atau judul">
        <button type="submit">cari film</button>
        <?php if ($keyword !== ""): ?>
            <a href="index.php">reset</a>
        <?php endif; ?>
    </form>

    <!-- tabel film -->
    <table>
        <thead>
            <tr>
                <th>poster</th>
                <th>id</th>
                <th>judul</th>
                <th>genre</th>
                <th>durasi</th>
                <th>harga tiket</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($daftarFilm)): ?>
                <tr>
                    <td colspan="7">data film kosong</td>
                </tr>
            <?php else: ?>
                <?php for ($i = 0; $i < count($daftarFilm); $i++): ?>
                    <?php 
                        $f = $daftarFilm[$i];
                        $pathGambar = $f->getGambar();
                    ?>
                    <tr>
                        <td>
                            <?php if (!empty($pathGambar) && file_exists(__DIR__ . "/" . $pathGambar)): ?>
                                <img src="<?= htmlspecialchars($pathGambar) ?>" alt="poster" width="50" height="65" style="object-fit: cover;">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($f->getId()) ?></td>
                        <td><?= htmlspecialchars($f->getJudul()) ?></td>
                        <td><?= htmlspecialchars($f->getGenre()) ?></td>
                        <td><?= htmlspecialchars((string)$f->getDurasi()) ?> menit</td>
                        <td>rp <?= htmlspecialchars((string)$f->getHargaTiket()) ?></td>
                        <td>
                            <a href="index.php?aksi=edit&id=<?= urlencode($f->getId()) ?>">edit</a> | 
                            <a href="index.php?aksi=hapus&id=<?= urlencode($f->getId()) ?>" onclick="return confirm('hapus film ini?')">hapus</a>
                        </td>
                    </tr>
                <?php endfor; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <p>total film: <?= count($daftarFilm) ?></p>
</div>

</body>
</html>
