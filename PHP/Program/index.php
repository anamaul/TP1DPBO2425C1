<?php
// Include file class ProdukElektronik
require_once "class.php";
// Memulai session untuk menyimpan data produk secara sementara
session_start();

// Inisialisasi session 'produk' jika belum ada
if (!isset($_SESSION['produk'])) {
  $_SESSION['produk'] = [];
}

// Variabel untuk menyimpan pesan feedback dan data yang akan diedit
$msg = "";
$editData = null;

// ========== PROSES TAMBAH / UPDATE PRODUK ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil dan bersihkan input dari form
  $id = trim($_POST['id']);
  $nama = trim($_POST['nama']);
  $watt = trim($_POST['watt']);
  $harga = trim($_POST['harga']);
  $gambarName = "";

  // Proses upload gambar jika ada file yang diupload
  if (!empty($_FILES['gambar']['name'])) {
    // Tentukan direktori upload
    $uploadDir = __DIR__ . "/uploads/";
    // Buat direktori jika belum ada
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }
    // Ambil ekstensi file
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    // Generate nama file unik dengan timestamp
    $gambarName = uniqid("img_") . "." . strtolower($ext);
    // Pindahkan file yang diupload ke direktori tujuan
    move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambarName);
  }

  // Proses UPDATE produk jika tombol update diklik
  if (isset($_POST['update'])) {
    // Loop melalui semua produk untuk mencari yang akan diupdate
    foreach ($_SESSION['produk'] as $p) {
      if ($p->getId() === $id) {
        // Update data produk
        $p->setNama($nama);
        $p->setWatt($watt);
        $p->setHarga($harga);
        // Update gambar hanya jika ada gambar baru yang diupload
        if ($gambarName)
          $p->setGambar($gambarName);
        $msg = "Produk berhasil diperbarui!";
        break;
      }
    }
  } else {
    // Proses TAMBAH produk baru
    $exists = false;
    // Cek apakah ID sudah ada
    foreach ($_SESSION['produk'] as $p) {
      if ($p->getId() === $id) {
        $exists = true;
        break;
      }
    }
    // Jika ID sudah ada, tampilkan pesan error
    if ($exists) {
      $msg = "Produk dengan ID $id sudah ada!";
    } else {
      // Tambah produk baru ke session
      $_SESSION['produk'][] = new ProdukElektronik($id, $nama, $watt, $harga, $gambarName);
      $msg = "Produk berhasil ditambahkan!";
    }
  }
}

// ========== PROSES HAPUS PRODUK ==========
if (isset($_GET['hapus'])) {
  $hapusId = $_GET['hapus'];
  // Loop untuk mencari dan menghapus produk berdasarkan ID
  foreach ($_SESSION['produk'] as $i => $p) {
    if ($p->getId() === $hapusId) {
      // Hapus produk dari array
      unset($_SESSION['produk'][$i]);
      // Reindex array agar tidak ada gap
      $_SESSION['produk'] = array_values($_SESSION['produk']);
      $msg = "Produk berhasil dihapus!";
      break;
    }
  }
}

// ========== AMBIL DATA UNTUK EDIT ==========
if (isset($_GET['edit'])) {
  $editId = $_GET['edit'];
  // Cari produk yang akan diedit berdasarkan ID
  foreach ($_SESSION['produk'] as $p) {
    if ($p->getId() === $editId) {
      $editData = $p; // Simpan data produk yang akan diedit
      break;
    }
  }
}

// ========== PROSES PENCARIAN ==========
// Ambil keyword pencarian dari parameter GET
$cariId = isset($_GET['cari_id']) ? trim($_GET['cari_id']) : '';

// Default tampilkan semua produk
$produkFiltered = $_SESSION['produk'];
// Jika ada keyword pencarian, filter produk
if ($cariId !== '') {
  $produkFiltered = array_filter($_SESSION['produk'], function ($p) use ($cariId) {
    // Menggunakan stripos untuk pencarian case-insensitive
    return stripos($p->getId(), $cariId) !== false;
  });
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Manajemen Produk Elektronik</title>
  <style>
    /* CSS untuk styling halaman */
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #999;
      padding: 8px;
      text-align: left;
    }

    img {
      max-width: 80px;
    }

    .msg {
      color: green;
    }
  </style>
</head>

<body>
  <h2>Manajemen Produk Elektronik</h2>

  <?php if (!empty($msg)): ?>
    <!-- Tampilkan pesan feedback jika ada -->
    <p class="msg"><?= htmlspecialchars($msg) ?></p>
  <?php endif; ?>

  <!-- Form untuk tambah/edit produk -->
  <h3><?= $editData ? "Edit Produk" : "Tambah Produk" ?></h3>
  <form method="post" enctype="multipart/form-data">
    <label>ID:</label><br>
    <!-- Input ID, readonly jika mode edit -->
    <input type="text" name="id" value="<?= $editData ? htmlspecialchars($editData->getId()) : "" ?>" <?= $editData ? "readonly" : "" ?> required><br>

    <label>Nama:</label><br>
    <!-- Input nama produk -->
    <input type="text" name="nama" value="<?= $editData ? htmlspecialchars($editData->getNama()) : "" ?>" required><br>

    <label>Watt:</label><br>
    <!-- Input konsumsi watt -->
    <input type="text" name="watt" value="<?= $editData ? htmlspecialchars($editData->getWatt()) : "" ?>" required><br>

    <label>Harga:</label><br>
    <!-- Input harga produk -->
    <input type="text" name="harga" value="<?= $editData ? htmlspecialchars($editData->getHarga()) : "" ?>"
      required><br>

    <label>Gambar:</label><br>
    <?php if ($editData && $editData->getGambar()): ?>
      <!-- Tampilkan gambar saat ini jika mode edit -->
      <img src="uploads/<?= htmlspecialchars($editData->getGambar()) ?>" alt="gambar"><br>
    <?php endif; ?>
    <!-- Input file untuk upload gambar -->
    <input type="file" name="gambar"><br><br>

    <?php if ($editData): ?>
      <!-- Tombol update untuk mode edit -->
      <button type="submit" name="update">Update</button>
      <a href="index.php">Batal</a>
    <?php else: ?>
      <!-- Tombol tambah untuk mode tambah -->
      <button type="submit" name="tambah">Tambah</button>
    <?php endif; ?>
  </form>
  <br>

  <!-- Form pencarian produk berdasarkan ID -->
  <form method="get" action="">
    <label for="cari_id">Cari berdasarkan ID:</label>
    <input type="text" name="cari_id" id="cari_id" value="<?= htmlspecialchars($cariId) ?>">
    <button type="submit">Cari</button>
    <a href="index.php">Reset</a>
  </form>
  <br>

  <!-- Tabel daftar produk -->
  <h3>Daftar Produk</h3>
  <?php if (empty($produkFiltered)): ?>
    <!-- Pesan jika tidak ada data -->
    <p>Data tidak ditemukan.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Watt</th>
          <th>Harga</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($produkFiltered as $p): ?>
          <tr>
            <!-- Tampilkan data produk dengan htmlspecialchars untuk keamanan -->
            <td><?= htmlspecialchars($p->getId()) ?></td>
            <td><?= htmlspecialchars($p->getNama()) ?></td>
            <td><?= htmlspecialchars($p->getWatt()) ?></td>
            <td><?= htmlspecialchars($p->getHarga()) ?></td>
            <td>
              <?php if ($p->getGambar()): ?>
                <!-- Tampilkan gambar jika ada -->
                <img src="uploads/<?= htmlspecialchars($p->getGambar()) ?>" alt="">
              <?php else: ?>
                <!-- Tampilkan tanda - jika tidak ada gambar -->
                -
              <?php endif; ?>
            </td>
            <td>
              <!-- Link untuk edit dan hapus produk -->
              <a href="?edit=<?= urlencode($p->getId()) ?>">Edit</a> |
              <a href="?hapus=<?= urlencode($p->getId()) ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

</body>

</html>