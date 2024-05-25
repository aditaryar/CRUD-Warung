<?php
include '../config.php';  // Pastikan path relatif untuk config.php benar

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO produk (nama_produk, harga, stok) VALUES ('$nama_produk', '$harga', '$stok')";

    if ($db->sqlquery($sql) === TRUE) {
        header("Location: view.php");  // Panggil index.php di root
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->get_error();
    }

    $db->close_con();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>RESTOCK PRODUK</h1>
    </div>
    <div class="bg"></div>
    <div class="boxB">
        <h2><img src="../img/restock.png" alt="" class="restok">Masukkan Barang</h2>
        <form method="post" action="">
            <div class="addB">
                <input type="text" name="nama_produk" placeholder="Nama Produk" required><br>
                <input type="number" name="harga" placeholder="Harga" required><br>
                <input type="number" name="stok" placeholder="Jumlah" required><br><br>
            </div>
            <div class="bt">
                <button class="btn" type="submit"><a href="view.php">Kembali</a></button>
                <button class="btn" type="submit" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
