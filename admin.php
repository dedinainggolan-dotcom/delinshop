<?php
include 'koneksi.php';

// Handle Tambah Produk
if(isset($_POST['add_product'])) {
    $name  = $_POST['name'];
    $cat   = $_POST['category'];
    $price = $_POST['price'];
    $disc  = $_POST['disc'];
    $stock = $_POST['stock'];
    $img   = $_POST['img'];
    $desc  = $_POST['description'];

    mysqli_query($conn, "INSERT INTO products (name, category, price, disc, stock, img, description) VALUES ('$name', '$cat', '$price', '$disc', '$stock', '$img', '$desc')");
    header("Location: admin.php");
}

// Handle Hapus Produk
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: admin.php");
}

$products = mysqli_query($conn, "SELECT * FROM products");
$orders   = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Delin shop</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-amber-50/30 text-gray-800 p-6">
    <div class="max-w-7xl mx-auto space-y-8">
        <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-amber-100">
            <div>
                <h1 class="text-2xl font-bold text-amber-950">Dashboard Admin Delin shop</h1>
                <p class="text-xs text-gray-500">Kelola database produk dan pantau pesanan pelanggan.</p>
            </div>
            <a href="index.php" class="bg-amber-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm">Lihat Toko Publik</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Tambah Produk -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-amber-100 h-fit">
                <h3 class="text-lg font-bold text-amber-950 mb-4">Tambah Produk Baru</h3>
                <form method="POST" class="space-y-3">
                    <input type="text" name="name" required placeholder="Nama Produk" class="w-full px-3 py-2 rounded-xl border text-sm">
                    <select name="category" class="w-full px-3 py-2 rounded-xl border text-sm bg-white">
                        <option value="Newborn">Newborn</option>
                        <option value="Setelan">Setelan</option>
                        <option value="Dress">Dress</option>
                    </select>
                    <input type="number" name="price" required placeholder="Harga Jual (Rp)" class="w-full px-3 py-2 rounded-xl border text-sm">
                    <input type="number" name="disc" value="0" placeholder="Diskon (Rp)" class="w-full px-3 py-2 rounded-xl border text-sm">
                    <input type="number" name="stock" required value="25" placeholder="Stok" class="w-full px-3 py-2 rounded-xl border text-sm">
                    <input type="text" name="img" value="👕" placeholder="Emoji / Gambar" class="w-full px-3 py-2 rounded-xl border text-sm">
                    <textarea name="description" rows="2" placeholder="Deskripsi..." class="w-full px-3 py-2 rounded-xl border text-sm">Katun organik nyaman.</textarea>
                    <button type="submit" name="add_product" class="w-full bg-amber-600 text-white py-2.5 rounded-xl font-semibold text-sm cursor-pointer">Simpan Produk</button>
                </form>
            </div>

            <!-- Tabel Produk & Daftar Pesanan -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-amber-100">
                    <h3 class="text-lg font-bold text-amber-950 mb-4">Daftar Produk Aktif di Database</h3>
                    <table class="w-full text-left text-sm">
                        <tr class="border-b text-gray-400 text-xs"><th>PRODUK</th><th>HARGA</th><th>STOK</th><th>AKSI</th></tr>
                        <?php while($p = mysqli_fetch_assoc($products)): ?>
                        <tr class="border-b">
                            <td class="py-3"><?php echo $p['img'] . ' ' . $p['name']; ?></td>
                            <td class="py-3">Rp <?php echo number_format($p['price'], 0, ',', '.'); ?></td>
                            <td class="py-3"><?php echo $p['stock']; ?></td>
                            <td class="py-3"><a href="admin.php?delete=<?php echo $p['id']; ?>" class="text-rose-600 font-semibold text-xs" onclick="return confirm('Hapus produk?')">Hapus</a></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-amber-100">
                    <h3 class="text-lg font-bold text-amber-950 mb-4">Daftar Pesanan Masuk (Checkout)</h3>
                    <table class="w-full text-left text-sm">
                        <tr class="border-b text-gray-400 text-xs"><th>PEMBELI</th><th>WHATSAPP</th><th>METODE</th><th>TOTAL</th></tr>
                        <?php while($o = mysqli_fetch_assoc($orders)): ?>
                        <tr class="border-b">
                            <td class="py-3"><?php echo $o['customer_name']; ?><br><span class="text-xs text-gray-400"><?php echo $o['address']; ?></span></td>
                            <td class="py-3"><?php echo $o['phone']; ?></td>
                            <td class="py-3"><?php echo $o['payment_method']; ?></td>
                            <td class="py-3 font-bold text-amber-900">Rp <?php echo number_format($o['total_amount'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>