<?php
include_once 'config/Database.php';
include_once 'classes/Product.php';

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    // Validasi sederhana
    if ($product->create($_POST['name'], $_POST['category'], $_POST['price'], $_POST['stock'], $_POST['status'], $_FILES['image'])) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menambah data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Tambah Produk</title></head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Tambah Produk Baru</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <p>Nama: <br><input type="text" name="name" required></p>
        
        <p>Kategori: <br>
            <select name="category">
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Makanan">Makanan</option>
            </select>
        </p>

        <p>Harga (Angka): <br><input type="number" name="price" min="0" required></p>
        <p>Stok (Angka): <br><input type="number" name="stock" min="0" required></p>

        <p>Status: <br>
            <input type="radio" name="status" value="active" checked> Active
            <input type="radio" name="status" value="inactive"> Inactive
        </p>

        <p>Foto Produk: <br><input type="file" name="image" required accept="image/*"></p>

        <input type="submit" value="Simpan Produk">
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>