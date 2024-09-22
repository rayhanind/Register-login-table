<?php
$host = 'localhost';
$dbname = 'user';
$username = 'root';  // Default user XAMPP/WAMP adalah 'root'
$password = '';      // Default password XAMPP/WAMP adalah kosong
// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
