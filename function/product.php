<?php
    include '../config.php';
    $db = new database();

    if(isset($_POST['SimpanProduk'])){
        $nama_produk = $_POST['nama_produk'];
        $id_kategori = $_POST['id_kategori'];
        $harga = $_POST['harga'];
    
        $sql = "CALL addProducts('$nama_produk', '$id_kategori', $harga)";
        $result = $db->sqlquery($sql);
    
        if ($result) {
            echo "Products berhasil ditambahkan!";
            header("Location: /products/view.php");
        } else {
            echo "Gagal menambahkan products: " . $db->get_error();
        }
    
        $db->close_con();
    }

    if(isset($_POST['SimpanStok'])){
        $id_produk = $_POST['id_produk'];
        $id_satuan = $_POST['id_satuan'];
        $stok = $_POST['stok'];
        $tgl_restok = $_POST['tgl_restok'];
    
        $sql = "CALL stokProducts('$id_produk', '$id_satuan', $stok, '$tgl_restok')";
        $result = $db->sqlquery($sql);
    
        if ($result) {
            echo "Products berhasil ditambahkan!";
            header("Location: /products/view.php");
        } else {
            echo "Gagal menambahkan products: " . $db->get_error();
        }
    
        $db->close_con();
    }

    if (isset($_POST['UpdateProduk'])) {
        if (!isset($_POST['id'])) {
            echo "Error: ID is missing.";
            exit;
        }
        $id = $_POST['id']; // Get the ID from the form
        $nama_produk = $_POST['nama_produk'];
        $id_kategori = $_POST['id_kategori'];
        $harga = $_POST['harga'];

        $sql = "CALL updateProduk($id,'$nama_produk', '$id_kategori', $harga)";

        if ($db->sqlquery($sql)) {
            header("Location: /products/view.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $db->get_error();
        }

        $db->close_con();
        
    }
?>