<?php
include 'config.php';

$db = new Database();

// Menentukan jumlah data per halaman
$limit = 5;

// Menentukan halaman saat ini
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query default untuk menampilkan semua data dengan paginasi
$sql = "SELECT 
        p.id AS ID,
        p.nama AS Nama_Pelanggan,
        pr.nama_produk AS Produk,
        pr.harga AS Harga,
        p.jumlah AS Jumlah,
        (pr.harga * p.jumlah) AS Total_Harga,
        p.tgl_pembelian AS Tanggal_Pembelian
    FROM 
        pelanggan p
    JOIN 
        produk pr ON p.id_produk = pr.id
    ORDER BY 
        p.id
    LIMIT $start, $limit";
$query_run = $db->fetchdata($sql);

// Mengambil total jumlah data
$totalResult = $db->sqlquery("SELECT COUNT(*) AS id FROM pelanggan")->fetch_assoc();
$total = $totalResult['id'];

// Menentukan total halaman
$totalPages = ceil($total / $limit);

if (isset($_GET['cari'])) {
    $filtervalues = $_GET['cari'];
    $query = "SELECT 
                p.id AS ID,
                p.nama AS Nama_Pelanggan,
                pr.nama_produk AS Produk,
                pr.harga AS Harga,
                p.jumlah AS Jumlah,
                (pr.harga * p.jumlah) AS Total_Harga,
                p.tgl_pembelian AS Tanggal_Pembelian
              FROM 
                pelanggan p
              JOIN 
                produk pr ON p.id_produk = pr.id
              WHERE 
                CONCAT(p.nama, pr.nama_produk) LIKE '%$filtervalues%'
              ORDER BY 
                p.id
              LIMIT $start, $limit";
    $query_run = $db->fetchdata($query);

    // Mengambil total jumlah data yang cocok dengan kriteria pencarian
    $totalResult = $db->sqlquery("SELECT COUNT(*) AS id FROM pelanggan p JOIN produk pr ON p.id_produk = pr.id WHERE CONCAT(p.nama, pr.nama_produk) LIKE '%$filtervalues%'")->fetch_assoc();
    $total = $totalResult['id'];

    // Menentukan total halaman yang cocok dengan kriteria pencarian
    $totalPages = ceil($total / $limit);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Warung</title>
  <link rel="icon" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>  
  <div class="bg"></div>
  <div class="header">
    <h1>
      DAFTAR PELANGGAN
    </h1>
  </div>
  <div class="pil">
      <div class="select">
        <a href="./products/view.php"><button>Daftar Produk</button></a>
        <a href="./orders/add.php"><button>Tambah Pelanggan</button></a>
      </div>
      <form method="GET" action="">
        <input class="cari" type="text" name="cari" value="<?php if(isset($_GET['cari'])){echo $_GET['cari']; }?>" placeholder="Cari">
      </form>
    </div>
  <div class="box">
    <div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal Pembelian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($query_run)) {
            // $i = 1;
            foreach ($query_run as $row) {
              echo "<tr>
                <td>".$row["ID"]."</td>
                <td>".$row["Nama_Pelanggan"]."</td>
                <td>".$row["Produk"]."</td> 
                <td>".$row["Harga"]."</td> 
                <td>".$row["Jumlah"]."</td> 
                <td>".$row["Total_Harga"]."</td> 
                <td>".$row["Tanggal_Pembelian"]."</td> 
                <td>
                  <a href='./orders/update.php?id=".$row["ID"]."'><button>Edit</button></a>
                  <a href='./orders/delete.php?id=".$row["ID"]."'><button>Delete</button></a>
                </td>
              </tr>";
              // $i++;
            }
          } else {
            echo (isset($_GET['cari'])) ? "
            <h2>Tidak ada data yang cocok dengan kriteria pencarian Anda.</h2>" : "<tr><td colspan='8'>Tidak ada data</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
  </div>
</body>
</html>
