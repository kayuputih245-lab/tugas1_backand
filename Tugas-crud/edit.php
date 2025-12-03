<?php
include_once 'config/Database.php';
include_once 'classes/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
$data = $product->show($id);

if ($_POST) {
    if ($product->update($id, $_POST['name'], $_POST['category'], $_POST['price'], $_POST['stock'], $_POST['status'], $_FILES['image'])) {
        header("Location: index.php");
    } else {
        echo "Gagal update data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Produk</title></head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Edit Produk</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <p>Nama: <br><input type="text" name="name" value="<?php echo $data['name']; ?>" required></p>
        
        <p>Kategori: <br>
            <select name="category">
                <option value="Elektronik" <?php if($data['category'] == 'Elektronik') echo 'selected'; ?>>Elektronik</option>
                <option value="Pakaian" <?php if($data['category'] == 'Pakaian') echo 'selected'; ?>>Pakaian</option>
                <option value="Makanan" <?php if($data['category'] == 'Makanan') echo 'selected'; ?>>Makanan</option>
            </select>
        </p>

        <p>Harga: <br><input type="number" name="price" value="<?php echo $data['price']; ?>" required></p>
        <p>Stok: <br><input type="number" name="stock" value="<?php echo $data['stock']; ?>" required></p>

        <p>Status: <br>
            <input type="radio" name="status" value="active" <?php if($data['status'] == 'active') echo 'checked'; ?>> Active
            <input type="radio" name="status" value="inactive" <?php if($data['status'] == 'inactive') echo 'checked'; ?>> Inactive
        </p>

        <p>Foto Saat Ini: <br>
            <img src="uploads/<?php echo $data['image_path']; ?>" width="100"><br>
            <small>Upload baru jika ingin mengganti:</small><br>
            <input type="file" name="image" accept="image/*">
        </p>

        <input type="submit" value="Update Produk">
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>