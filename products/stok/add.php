<?php
    include '../../config.php';
    $db = new Database();

    // $sql = "SELECT stok, harga FROM gudang WHERE id_produk AND id_satuan";
    // $data = $db->sqlquery($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stok Produk</title>
    <link rel="icon" href="/img/logo.png">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Stok Produk</h1>
    </div>
    <div class="bg"></div>
    <div class="boxB">
        <h2><img src="/img/restock.png" alt="" class="restok">Restok Barang</h2>
        <form method="post" action="/function/product.php">
            <div class="addB">
                <select name="id_produk" id="id_produk">
                    <?php
                        $sql_kt = "SELECT id, nama_produk FROM produk";
                        $data_kt = $db->fetchdata($sql_kt);
                        foreach ($data_kt as $dat_kt) {
                            echo "<option value='" . $dat_kt['id'] . "'>" . $dat_kt['nama_produk'] . "</option>";
                        }
                    ?>
                </select><br>
                <select name="id_satuan" id="id_satuan">
                    <?php
                        $sql_kt = "SELECT id, nama_satuan FROM satuan";
                        $data_kt = $db->fetchdata($sql_kt);
                        foreach ($data_kt as $dat_kt) {
                            echo "<option value='" . $dat_kt['id'] . "'>" . $dat_kt['nama_satuan'] . "</option>";
                        }
                    ?>
                </select><br>
                <input type="number" name="stok"  placeholder="Jumlah Stok" required><br> <!-- Pada Line ini tambahkan value sesuai dengan database -->
                <input type="date" name="tgl_restok" required><br><br>
            </div>
            <div class="bt">
                <button class="btn" type="submit"><a href="/products/view.php">Kembali</a></button>
                <button class="btn" type="submit" name="SimpanStok" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
