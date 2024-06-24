<?php
    include '../config.php';
    $db = new database();

    if(isset($_POST['Simpan'])){
        $nama = $_POST['nama'];
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];
        $tanggal_pembelian = $_POST['tanggal_pembelian'];

    
        $sql = "CALL addOrders('$nama', '$id_produk', $jumlah, '$tanggal_pembelian')";
         
    
        if (!$db->sqlquery($sql)) {
            echo "Gagal menambahkan data ke tabel pelanggan: " . $db->get_error();
        } else {
            echo "Order berhasil ditambahkan!";
            header("Location: ../index.php");
        }
    
        $db->close_con();
    }

    if (isset($_POST['Update'])) {
        if (!isset($_POST['id'])) {
            echo "Error: ID is missing.";
            exit;
        }
        $id = $_POST['id']; // Get the ID from the form
        $nama = $_POST['nama'];
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
    
        $query = "CALL updateOrders($id, '$nama', '$id_produk', $jumlah, '$tanggal_pembelian')";
        if ($db->sqlquery($query)) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . $query . "<br>" . $db->get_error();
        }
    }
?>