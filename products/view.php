<?php
include '../config.php';

$db = new Database();
$sql = "SELECT pr.id AS ID, pr.nama_produk AS NamaProduk, pr.harga AS Harga, g.stok AS Stok
        FROM gudang g
        JOIN produk pr ON g.id_produk = pr.id
        ORDER BY g.id;";
$produk = $db->fetchdata($sql);
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
                <a href="stok/add.php"><button>Stok Produk</button></a>
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
                    if (!empty($produk)) {
                        $i = 1;
                        foreach ($produk as $row) {
                            echo "<tr>
                                    <td>$i</td>
                                    <td>".$row["NamaProduk"]."</td>
                                    <td>".$row["Harga"]."</td>
                                    <td>".$row["Stok"]."</td>
                                    <td>
                                        <a href='update.php?id=".$row["ID"]."'><button>Edit</button></a>
                                        <a href='delete.php?id=".$row["ID"]."'><button>Delete</button></a>
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
