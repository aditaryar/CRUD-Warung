<?php

include '../config.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tgl_pembelian = $_POST['tgl_pembelian'];

    // Mulai transaksi
    $db->begin_transaction();

    try {
        // Query untuk menambahkan data ke tabel pelanggan
        $sql_insert_pelanggan = "INSERT INTO pelanggan (nama, id_produk, jumlah, tgl_pembelian) VALUES ('$nama', '$id_produk', '$jumlah', '$tgl_pembelian')";
        
        if (!$db->sqlquery($sql_insert_pelanggan)) {
            throw new Exception("Gagal menambahkan data ke tabel pelanggan: " . $db->get_error());
        }

        // Query untuk mengurangi stok di tabel produk
        $sql_update_stok = "UPDATE produk SET stok = stok - $jumlah WHERE id = $id_produk";
        
        if (!$db->sqlquery($sql_update_stok)) {
            throw new Exception("Gagal mengurangi stok produk: " . $db->get_error());
        }

        // Commit transaksi
        $db->commitTransaction();
        header("Location: ../index.php");  // Panggil index.php di root
        exit();

    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $db->rollbackTransaction();
        echo "Error: " . $e->getMessage();
    }

    $db->close_con();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pelanggan</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>PELANGGAN</h1>
    </div>
    <div class="bg"></div>
    <div class="box2">
        <h2><img src="../img/kasir.png" alt="" class="kasir">Pembelian Produk</h2>
        <form method="post" action="add.php">
            <div class="add">
                <input type="text" name="nama" placeholder="Nama" required><br>
                <select name="id_produk">
                    <?php
                        $sql_pr = "SELECT id, nama_produk, harga FROM produk"; // Include 'harga' column
                        $data_pr = $db->fetchdata($sql_pr);
                        foreach ($data_pr as $dat_pr) {
                            echo "<option value='" . $dat_pr['id'] . "'>" . $dat_pr['nama_produk'] . " (Rp" . $dat_pr['harga'] . ")</option>";
                        }
                    ?>
                </select><br>
                <input type="number" name="jumlah" placeholder="Jumlah" required><br>
                <input type="date" name="tgl_pembelian" placeholder="Tanggal Pembelian" required>
            </div><br>
            <div class="bt">
                <button class="btn" type="submit"><a href="../index.php">Kembali</a></button>
                <button class="btn" type="submit" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
