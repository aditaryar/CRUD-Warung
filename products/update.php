<?php
    include '../config.php';
    $db = new database();
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $produk = $db->datasql("SELECT * FROM produk WHERE id = $id");
    
        if (!$produk) {
            echo "Error: Produk tidak ditemukan.";
            exit();
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
        <form method="post" action="/function/product.php">
            <div class="addB">
                <select name="nama_produk">
                    <?php
                        $sql_pr = "SELECT id, nama_produk FROM produk"; // Include 'harga' column
                        $data_pr = $db->fetchdata($sql_pr);
                        foreach ($data_pr as $dat_pr) {
                            echo "<option value='" . $dat_pr['id'] . "'>" . $dat_pr['nama_produk'] . "</option>";
                        }
                    ?>
                </select><br>
                <select name="id_kategori">
                    <?php
                        $sql_kt = "SELECT id, nama_kategori FROM kategori";
                        $data_kt = $db->fetchdata($sql_kt);
                        foreach ($data_kt as $dat_kt) {
                            echo "<option value='" . $dat_kt['id'] . "'>" . $dat_kt['nama_kategori'] . "</option>";
                        }
                    ?>
                </select><br>
                <input type="number" name="harga" value="<?= $produk['harga'] ?>" placeholder="harga" required><br><br>
            </div>
            <div class="bt">
                <button class="btn" type="submit"><a href="view.php">Kembali</a></button>
                <button class="btn" type="submit" name="UpdateProduk" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>