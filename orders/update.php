<?php
include '../config.php';

$db = new Database();

// $query = "SELECT kodeGudang AS id,
//                  nama,
//                  id_produk AS id_produk,
//                  jumlah AS jumlah,
//                  tanggal_pembelian AS tanggal_pembelian
//             FROM pelanggan;";
// $transaksi = $db->datasql($query);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $transaksi = $db->datasql("SELECT * FROM pelanggan WHERE id = $id");
} else {
    echo "Error: ID produk tidak ditemukan.";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="header">
        <h1>UPDATE PELANGGAN</h1>
    </div>
    <div class="bg"></div>
    <div class="box2">
        <h2><img src="../img/kasir.png" alt="" class="kasir">Pembelian Produk</h2>
        <form method="post" action="/function/orders.php">
        <div class="add">
                <input type="hidden" name="id" value="<?= $transaksi['id'] ?>">
                <input type="text" name="nama" value="<?= $transaksi['nama'] ?>" placeholder="Nama" required><br>
                <select name="id_produk">
                    <?php
                        $sql_pr = "SELECT id, nama_produk, harga FROM produk"; // Include 'harga' column
                        $data_pr = $db->fetchdata($sql_pr);
                        foreach ($data_pr as $dat_pr) {
                            echo "<option value='" . $dat_pr['id'] . "'>" . $dat_pr['nama_produk'] . " (Rp" . $dat_pr['harga'] . ")</option>";
                        }
                    ?>
                </select><br>
                <input type="number" name="jumlah" value="<?= $transaksi['jumlah'] ?>" placeholder="Jumlah" required><br>
                <input type="date" name="tanggal_pembelian" value="<?= $transaksi['tanggal_pembelian'] ?>" placeholder="Tanggal Pembelian" required>
            </div><br>
            <div class="bt">
                <button class="btn" type="submit"><a href="../index.php">Kembali</a></button>
                <button class="btn" type="submit" name="Update" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
