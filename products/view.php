<?php
include '../config.php';

$db = new Database();
$produk = $db->fetchdata("SELECT * FROM produk WHERE id");

$query_run = $produk;

if (isset($_GET['cari'])) {
    $filtervalues = $_GET['cari'];
    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$filtervalues%'";
    $query_run = $db->fetchdata($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>DAFTAR PRODUK</h1>
    </div>
    <div class="bg"></div>
    <div class="pil">
            <div class="select">
                <a href="../index.php"><button>Daftar Pelanggan</button></a>
                <a href="add.php"><button>Tambah Produk</button></a>
            </div>
            <form method="GET" action="">
                <input class="cariV" type="text" name="cari" value="<?php if(isset($_GET['cari'])){echo $_GET['cari']; }?>" placeholder="Cari">
            </form>
        </div>
    <div class="boxV">
        <div class="pil-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php
                    if (!empty($query_run)) {
                        $i = 1;
                        foreach ($query_run as $row) {
                            echo "<tr>
                                    <td>$i</td>
                                    <td>".$row["nama_produk"]."</td>
                                    <td>".$row["harga"]."</td>
                                    <td>".$row["stok"]."</td>
                                    <td>
                                        <a href='update.php?id=".$row["id"]."'><button>Edit</button></a>
                                        <a href='delete.php?id=".$row["id"]."'><button>Delete</button></a>
                                    </td>                                
                                 </tr>";
                            $i++;
                        }
                    } else {
                        echo (isset($_GET['cari'])) ? "<h2>Tidak ada data yang cocok dengan kriteria pencarian Anda.</h2>" : "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    ?>                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
