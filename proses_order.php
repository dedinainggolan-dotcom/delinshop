<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment_method']);
    
    $cart = json_decode($_POST['cart_data'], true);
    $total_amount = 0;
    foreach($cart as $item) {
        $total_amount += ($item['price'] - $item['disc']) * $item['qty'];
    }

    $query = "INSERT INTO orders (customer_name, phone, address, payment_method, total_amount) VALUES ('$name', '$phone', '$address', '$payment', '$total_amount')";
    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Pesanan berhasil dibuat di Delin shop!'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses pesanan: " . mysqli_error($conn);
    }
}
?>