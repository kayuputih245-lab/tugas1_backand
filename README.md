Cara Menggunakan Website CRUD Produk (Deskripsi Lengkap)

Website ini berfungsi untuk mengelola data produk seperti menambah, menampilkan, mengubah, dan menghapus produk. Semua data disimpan pada database melalui proses backend PHP.

1. Mengakses Halaman Utama

Setelah website dijalankan melalui localhost atau hosting, pengguna akan diarahkan ke halaman Daftar Produk.
Pada halaman ini sistem otomatis mengambil data dari database menggunakan method read() dari class Product, lalu menampilkannya dalam tabel.

2. Melihat Daftar Produk

Pada halaman utama terdapat sebuah tabel yang berisi daftar produk.
Setiap produk akan menampilkan:

Foto produk (diambil dari folder uploads/)

Nama produk

Kategori produk

Harga yang diperlihatkan dengan format rupiah

Stok barang

Status produk (misalnya tersedia / habis)

Data ini ditampilkan menggunakan perulangan PHP while yang membaca hasil query dari database.

3. Menambah Produk Baru

Untuk menambah produk, pengguna menekan tombol “+ Tambah Produk”.
Tombol ini akan mengarahkan pengguna ke halaman create.php, di mana terdapat form pengisian data seperti:

Nama produk

Kategori

Harga

Stok

Status

Upload foto

Setelah form dikirim, sistem akan menyimpan data baru ke database dan foto ke folder uploads/.

4. Mengedit Produk

Setiap baris produk memiliki tombol Edit yang akan mengarahkan ke halaman edit.php.
Pada halaman tersebut, data produk sebelumnya akan otomatis ditampilkan pada form.
Pengguna dapat memperbarui data lalu menyimpannya kembali ke database.

5. Menghapus Produk

Pada setiap baris produk juga terdapat tombol Hapus.
Jika tombol ini ditekan, sistem akan meminta konfirmasi terlebih dahulu.
Jika setuju, data produk akan dihapus dari database.
