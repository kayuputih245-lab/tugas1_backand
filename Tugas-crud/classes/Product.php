<?php
class Product {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    // --- READ (Ambil semua data) ---
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // --- READ SINGLE (Ambil 1 data untuk Edit) ---
    public function show($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- CREATE (Tambah Data) ---
    public function create($name, $category, $price, $stock, $status, $file) {
        // Handle File Upload
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($file["name"]); // Rename agar unik
        $target_file = $target_dir . $file_name;
        
        // Validasi dan Upload
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $query = "INSERT INTO " . $this->table_name . " SET name=:name, category=:category, price=:price, stock=:stock, status=:status, image_path=:image";
            
            $stmt = $this->conn->prepare($query);
            
            // Binding data (Prepared Statement untuk keamanan)
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":stock", $stock);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":image", $file_name);

            return $stmt->execute();
        }
        return false;
    }

    // --- UPDATE (Ubah Data) ---
    public function update($id, $name, $category, $price, $stock, $status, $file) {
        $image_query = "";
        $file_name = "";

        // Cek jika user upload gambar baru
        if (!empty($file["name"])) {
            $target_dir = "uploads/";
            $file_name = time() . "_" . basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $target_dir . $file_name);
            $image_query = ", image_path=:image";
        }

        $query = "UPDATE " . $this->table_name . " SET name=:name, category=:category, price=:price, stock=:stock, status=:status" . $image_query . " WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":stock", $stock);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        
        if (!empty($file["name"])) {
            $stmt->bindParam(":image", $file_name);
        }

        return $stmt->execute();
    }

    // --- DELETE (Hapus Data) ---
    public function delete($id) {
        // Opsional: Hapus file gambar lama jika perlu
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>