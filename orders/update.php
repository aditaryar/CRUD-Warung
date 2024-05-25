<?php
include '../config.php';

$db = new Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM pelanggan WHERE id = $id";
    $result = $db->sqlquery($query);
    $transaksi = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tgl_pembelian = $_POST['tgl_pembelian'];

    $query = "UPDATE pelanggan SET id='$id', id_produk='$id_produk', jumlah='$jumlah', tgl_pembelian='$tgl_pembelian' WHERE id='$id'";
    if ($db->sqlquery($query)) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->get_error();
    }
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
        <form method="post" action="">
        <div class="add">
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
                <input type="date" name="tgl_pembelian" value="<?= $transaksi['tgl_pembelian'] ?>" placeholder="Tanggal Pembelian" required>
            </div><br>
            <div class="bt">
                <button class="btn" type="submit"><a href="../index.php">Kembali</a></button>
                <button class="btn" type="submit" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
