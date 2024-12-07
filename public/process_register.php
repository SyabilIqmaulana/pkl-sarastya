<?php
require '../config/db.php'; // Pastikan jalur file konfigurasi benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    try {
        // Query untuk menyimpan data pengguna
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);
        echo "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Akses tidak valid.";
}
?>
