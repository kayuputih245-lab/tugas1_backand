<?php
include_once 'config/Database.php';
include_once 'classes/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$stmt = $product->read();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>

    <!-- KONEKSI STYLE DARI FOLDER css -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <h2>Daftar Produk (Tugas Backend)</h2>
    <a href="create.php" class="btn btn-add">+ Tambah Produk</a>
    
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><img src="uploads/<?php echo $row['image_path']; ?>" alt="Foto"></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-del" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
