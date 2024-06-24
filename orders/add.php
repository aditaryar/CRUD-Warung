<?php
    include '../config.php';
    $db = new Database();
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
        <form method="post" action="/function/orders.php">
            <div class="add">
                <input type="text" name="nama" placeholder="Nama" required><br>
                <select name="id_produk">
                    <?php
                        $sql_pr = "SELECT pr.id AS id, pr.nama_produk AS nama_produk, g.harga AS harga FROM gudang g JOIN produk pr ON g.id_produk = pr.id;"; // Include 'harga' column
                        $data_pr = $db->fetchdata($sql_pr);
                        foreach ($data_pr as $dat_pr) {
                            echo "<option value='" . $dat_pr['id'] . "'>" . $dat_pr['nama_produk'] . " (Rp" . $dat_pr['harga'] . ")</option>";
                        }
                    ?>
                </select><br>
                <input type="number" name="jumlah" placeholder="Jumlah" required><br>
                <input type="date" name="tanggal_pembelian" placeholder="Tanggal Pembelian" required>
            </div><br>
            <div class="bt">
                <button class="btn" type="submit"><a href="../index.php">Kembali</a></button>
                <button class="btn" type="submit" name="Simpan" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
