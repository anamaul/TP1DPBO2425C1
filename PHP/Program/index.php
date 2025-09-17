<?php
require_once "class.php";
session_start();

if (!isset($_SESSION['produk'])) {
  $_SESSION['produk'] = [];
}
$msg = "";
$editData = null;

// ========== TAMBAH / UPDATE ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = trim($_POST['id']);
  $nama = trim($_POST['nama']);
  $watt = trim($_POST['watt']);
  $harga = trim($_POST['harga']);
  $gambarName = "";

  // Upload gambar jika ada
  if (!empty($_FILES['gambar']['name'])) {
    $uploadDir = __DIR__ . "/uploads/";
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $gambarName = uniqid("img_") . "." . strtolower($ext);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambarName);
  }

  if (isset($_POST['update'])) {
    // UPDATE
    foreach ($_SESSION['produk'] as $p) {
      if ($p->getId() === $id) {
        $p->setNama($nama);
        $p->setWatt($watt);
        $p->setHarga($harga);
        if ($gambarName)
          $p->setGambar($gambarName);
        $msg = "Produk berhasil diperbarui!";
        break;
      }
    }
  } else {
    // TAMBAH
    $exists = false;
    foreach ($_SESSION['produk'] as $p) {
      if ($p->getId() === $id) {
        $exists = true;
        break;
      }
    }
    if ($exists) {
      $msg = "Produk dengan ID $id sudah ada!";
    } else {
      $_SESSION['produk'][] = new ProdukElektronik($id, $nama, $watt, $harga, $gambarName);
      $msg = "Produk berhasil ditambahkan!";
    }
  }
}

// ========== HAPUS ==========
if (isset($_GET['hapus'])) {
  $hapusId = $_GET['hapus'];
  foreach ($_SESSION['produk'] as $i => $p) {
    if ($p->getId() === $hapusId) {
      unset($_SESSION['produk'][$i]);
      $_SESSION['produk'] = array_values($_SESSION['produk']);
      $msg = "Produk berhasil dihapus!";
      break;
    }
  }
}

// ========== AMBIL DATA EDIT ==========
if (isset($_GET['edit'])) {
  $editId = $_GET['edit'];
  foreach ($_SESSION['produk'] as $p) {
    if ($p->getId() === $editId) {
      $editData = $p;
      break;
    }
  }
}

// ambil keyword pencarian
$cariId = isset($_GET['cari_id']) ? trim($_GET['cari_id']) : '';

$produkFiltered = $_SESSION['produk'];
if ($cariId !== '') {
  $produkFiltered = array_filter($_SESSION['produk'], function ($p) use ($cariId) {
    // bisa gunakan === jika ingin persis, atau stripos untuk "like"
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
    <p class="msg"><?= htmlspecialchars($msg) ?></p>
  <?php endif; ?>

  <h3><?= $editData ? "Edit Produk" : "Tambah Produk" ?></h3>
  <form method="post" enctype="multipart/form-data">
    <label>ID:</label><br>
    <input type="text" name="id" value="<?= $editData ? htmlspecialchars($editData->getId()) : "" ?>" <?= $editData ? "readonly" : "" ?> required><br>

    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $editData ? htmlspecialchars($editData->getNama()) : "" ?>" required><br>

    <label>Watt:</label><br>
    <input type="text" name="watt" value="<?= $editData ? htmlspecialchars($editData->getWatt()) : "" ?>" required><br>

    <label>Harga:</label><br>
    <input type="text" name="harga" value="<?= $editData ? htmlspecialchars($editData->getHarga()) : "" ?>"
      required><br>

    <label>Gambar:</label><br>
    <?php if ($editData && $editData->getGambar()): ?>
      <img src="uploads/<?= htmlspecialchars($editData->getGambar()) ?>" alt="gambar"><br>
    <?php endif; ?>
    <input type="file" name="gambar"><br><br>

    <?php if ($editData): ?>
      <button type="submit" name="update">Update</button>
      <a href="index.php">Batal</a>
    <?php else: ?>
      <button type="submit" name="tambah">Tambah</button>
    <?php endif; ?>
  </form>
  <br>
  <form method="get" action="">
    <label for="cari_id">Cari berdasarkan ID:</label>
    <input type="text" name="cari_id" id="cari_id" value="<?= htmlspecialchars($cariId) ?>">
    <button type="submit">Cari</button>
    <a href="index.php">Reset</a>
  </form>
  <br>

  <h3>Daftar Produk</h3>
  <?php if (empty($produkFiltered)): ?>
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
            <td><?= htmlspecialchars($p->getId()) ?></td>
            <td><?= htmlspecialchars($p->getNama()) ?></td>
            <td><?= htmlspecialchars($p->getWatt()) ?></td>
            <td><?= htmlspecialchars($p->getHarga()) ?></td>
            <td>
              <?php if ($p->getGambar()): ?>
                <img src="uploads/<?= htmlspecialchars($p->getGambar()) ?>" alt="">
              <?php else: ?>-
              <?php endif; ?>
            </td>
            <td>
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