<?php
include '../config.php';

$db = new Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM produk WHERE id = $id";
    if ($db->sqlquery($query)) {
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->get_error();
    }
}
$db->close_con();
?>
