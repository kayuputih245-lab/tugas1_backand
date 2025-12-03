<?php
include_once 'config/Database.php';
include_once 'classes/Product.php';

if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    
    if ($product->delete($_GET['id'])) {
        header("Location: index.php");
    } else {
        echo "Gagal menghapus data.";
    }
}
?>