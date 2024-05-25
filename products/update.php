<?php
include '../config.php';

$db = new Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk = $db->datasql("SELECT * FROM produk WHERE id = $id");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_produk = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $sql = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id_produk=$id";

        if ($db->sqlquery($sql) === TRUE) {
            header("Location: view.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $db->get_error();
        }

        $db->close_con();
    }
} else {
    echo "Error: ID produk tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>UPDATE PRODUK</h1>
    </div>
    <div class="bg"></div>
    <div class="boxB">
        <h2><img src="../img/replacement.png" alt="" class="restok">Mengganti Barang</h2>
        <form method="post" action="">
            <div class="addB">
                <input type="text" name="nama_produk" value="<?= $produk['nama_produk'] ?>" placeholder="Nama Produk" required><br>
                <input type="number" name="harga" value="<?= $produk['harga'] ?>" placeholder="Harga" required><br>
                <input type="number" name="stok" value="<?= $produk['stok'] ?>" placeholder="Jumlah" required><br><br>
            </div>
            <div class="bt">
                <button class="btn" type="submit"><a href="view.php">Kembali</a></button>
                <button class="btn" type="submit" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
