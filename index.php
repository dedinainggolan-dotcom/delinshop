<?php
include 'koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delin shop - Pakaian Anak & Bayi Berkualitas</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3, h4, .font-brand { font-family: 'Quicksand', sans-serif; }
    </style>
</head>
<body class="bg-amber-50/30 text-gray-800 antialiased selection:bg-amber-200">

    <!-- Top Announcement Bar -->
    <div class="bg-amber-600 text-white text-xs sm:text-sm py-2 px-4 text-center font-medium flex justify-between items-center">
        <div class="hidden sm:block">✨ Garansi Bahan 100% Cotton Organik, Adem & Lembut untuk Kulit Bayi</div>
        <div class="mx-auto sm:mx-0">📦 Gunakan Kupon <span class="bg-amber-700 px-2 py-0.5 rounded font-bold">DELINSHOPFREE</span> Diskon 15%!</div>
        <div class="hidden sm:flex items-center gap-3">
            <a href="admin.php" class="hover:underline opacity-90"><i class="fa-solid fa-lock mr-1"></i> Admin Panel</a>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-amber-100 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3 cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 font-bold text-xl shadow-inner">
                    <i class="fa-solid fa-child-reaching"></i>
                </div>
                <div>
                    <span class="text-2xl font-bold tracking-tight text-amber-900 font-brand">Delin shop</span>
                    <p class="text-xs text-amber-600/80 font-medium">Kids & Baby Wear</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="toggleCart()" class="relative bg-amber-50 hover:bg-amber-100 text-amber-900 w-11 h-11 rounded-full flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                    <span id="cart-badge" class="absolute -top-1 -right-1 bg-rose-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-amber-100/60 via-amber-50 to-orange-50/50 py-16 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center text-center md:text-left">
            <div class="space-y-6">
                <span class="bg-amber-200/60 text-amber-900 text-xs sm:text-sm font-semibold px-4 py-1.5 rounded-full">
                    <i class="fa-solid fa-award text-amber-700"></i> Brand Lokal Berkualitas Ekspor
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-amber-950 font-brand leading-tight">
                    Nyaman & Modis untuk Si Buah Hati 👶
                </h1>
                <p class="text-gray-600 text-base sm:text-lg">Koleksi pakaian anak dan bayi berbahan katun organik premium yang adem dan anti-alergi di Delin shop.</p>
            </div>
        </div>
    </section>

    <!-- Product Catalog Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-amber-950 font-brand mb-8">Katalog Pilihan Delin shop</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php while($p = mysqli_fetch_assoc($query)):$finalPrice = $p['price'] -$p['disc'];
            ?>
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-amber-100 flex flex-col justify-between">
                <div>
                    <div class="h-44 rounded-2xl bg-amber-50 flex items-center justify-center text-6xl mb-4 relative">
                        <span><?php echo $p['img']; ?></span>
                        <?php if($p['disc'] > 0): ?>
                            <span class="absolute top-3 left-3 bg-rose-500 text-white text-[10px] font-bold px-2 py-1 rounded-full">Diskon</span>
                        <?php endif; ?>
                        <span class="absolute bottom-3 right-3 bg-white/90 text-amber-900 text-[10px] font-bold px-2 py-0.5 rounded-lg">Stok: <?php echo $p['stock']; ?></span>
                    </div>
                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md"><?php echo $p['category']; ?></span>
                    <h3 class="font-bold text-gray-900 text-base mt-2 font-brand"><?php echo $p['name']; ?></h3>
                    <p class="text-gray-500 text-xs mt-1"><?php echo $p['description']; ?></p>
                </div>
                <div class="mt-4 pt-4 border-t border-amber-50 flex items-center justify-between">
                    <div>
                        <span class="text-amber-900 font-bold text-base font-brand">Rp <?php echo number_format($finalPrice, 0, ',', '.'); ?></span>
                        <?php if($p['disc'] > 0): ?>
                            <br><span class="text-gray-400 line-through text-xs">Rp <?php echo number_format($p['price'], 0, ',', '.'); ?></span>
                        <?php endif; ?>
                    </div>
                    <button onclick='addToCart(<?php echo json_encode($p); ?>)' class="bg-amber-600 hover:bg-amber-700 text-white w-10 h-10 rounded-xl flex items-center justify-center transition shadow-md cursor-pointer">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Slide-over Cart Drawer -->
    <div id="cart-drawer" class="fixed inset-0 z-50 bg-black/50 hidden">
        <div class="absolute inset-y-0 right-0 max-w-md w-full bg-white shadow-2xl flex flex-col">
            <div class="p-5 border-b flex items-center justify-between">
                <h3 class="font-bold text-lg text-amber-950 font-brand">Keranjang Belanjaan</h3>
                <button onclick="toggleCart()" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="cart-items-container" class="flex-1 overflow-y-auto p-5 space-y-4"></div>
            <div class="p-5 border-t bg-amber-50/50 space-y-3">
                <div class="flex justify-between font-bold text-base text-amber-950"><span>Total Pembayaran</span><span id="cart-total">Rp 0</span></div>
                <button onclick="openCheckoutModal()" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3.5 rounded-2xl font-semibold text-sm cursor-pointer">Checkout Pesanan</button>
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div id="checkout-modal" class="fixed inset-0 z-50 bg-black/60 hidden flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-3xl p-6 shadow-2xl space-y-6">
            <h3 class="text-xl font-bold text-amber-950 font-brand">Formulir Checkout Pesanan</h3>
            <form action="proses_order.php" method="POST" class="space-y-4">
                <input type="hidden" name="cart_data" id="hidden-cart-data">
                <div><label class="block text-xs font-semibold mb-1">Nama Lengkap</label><input type="text" name="customer_name" required class="w-full px-4 py-2.5 rounded-xl border text-sm"></div>
                <div><label class="block text-xs font-semibold mb-1">Nomor WhatsApp</label><input type="text" name="phone" required class="w-full px-4 py-2.5 rounded-xl border text-sm"></div>
                <div><label class="block text-xs font-semibold mb-1">Alamat Lengkap</label><textarea name="address" required rows="2" class="w-full px-4 py-2.5 rounded-xl border text-sm"></textarea></div>
                <div><label class="block text-xs font-semibold mb-1">Metode Pembayaran</label>
                    <select name="payment_method" class="w-full px-4 py-2.5 rounded-xl border text-sm bg-white">
                        <option value="QRIS">QRIS</option>
                        <option value="Transfer BCA">Transfer BCA</option>
                        <option value="COD">COD (Bayar di Tempat)</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-amber-600 text-white py-3 rounded-xl font-semibold cursor-pointer">Kirim Pesanan</button>
            </form>
        </div>
    </div>

    <script>
        let cart = [];
        function toggleCart() { document.getElementById('cart-drawer').classList.toggle('hidden'); renderCart(); }
        function addToCart(prod) {
            let found = cart.find(item => item.id === prod.id);
            if(found) { found.qty++; } else { cart.push({ ...prod, qty: 1 }); }
            document.getElementById('cart-badge').innerText = cart.reduce((a,b)=>a+b.qty,0);
            toggleCart();
        }
        function renderCart() {
            let container = document.getElementById('cart-items-container');
            container.innerHTML = '';
            let total = 0;
            cart.forEach(item => {
                let finalP = item.price - item.disc;
                total += finalP * item.qty;
                container.innerHTML += `<div class="flex justify-between items-center border-b pb-2"><div><h4 class="font-bold text-xs">${item.name}</h4><span class="text-xs text-amber-600">Rp ${finalP.toLocaleString()} x ${item.qty}</span></div></div>`;
            });
            document.getElementById('cart-total').innerText = 'Rp ' + total.toLocaleString();
        }
        function openCheckoutModal() {
            document.getElementById('hidden-cart-data').value = JSON.stringify(cart);
            document.getElementById('checkout-modal').classList.remove('hidden');
        }
    </script>
</body>
</html>