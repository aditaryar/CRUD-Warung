<?php
    include '../config.php';
    $db = new Database();
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
        <h1>Tambah Produk</h1>
    </div>
    <div class="bg"></div>
    <div class="boxB">
        <h2><img src="../img/restock.png" alt="" class="restok">Masukkan Barang</h2>
        <form method="post" action="../function/product.php">
            <div class="addB">
                <input type="text" name="nama_produk" placeholder="Nama Produk" required><br>
                <select name="id_kategori">
                    <?php
                        $sql_kt = "SELECT id, nama_kategori FROM kategori";
                        $data_kt = $db->fetchdata($sql_kt);
                        foreach ($data_kt as $dat_kt) {
                            echo "<option value='" . $dat_kt['id'] . "'>" . $dat_kt['nama_kategori'] . "</option>";
                        }
                    ?>
                </select><br>
                <input type="number" name="harga" placeholder="Harga" required><br><br>
                <!-- <input type="number" name="stok" placeholder="Jumlah Stok" required><br>
                <input type="date" name="tgl_restok" required><br><br> -->
            </div>
            <div class="bt">
                <button class="btn" type="submit"><a href="view.php">Kembali</a></button>
                <button class="btn" type="submit" name="SimpanProduk" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
