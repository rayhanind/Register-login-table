<?php
session_start();
include 'db.php'; // Pastikan file ini menghubungkan ke database

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Cek apakah username sudah ada
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>Username sudah digunakan!</p>";
    } else {
        // Insert pengguna baru ke database
        $insert_sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ss", $username, $password);

        if ($insert_stmt->execute()) {
            echo "<p style='color:green;'>Registrasi berhasil! Silakan <a href='login.php'>login</a>.</p>";
        } else {
            echo "<p style='color:red;'>Terjadi kesalahan saat registrasi.</p>";
        }

        $insert_stmt->close();
    }

    $stmt->close();
}
?>
