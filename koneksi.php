<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nusa_griya';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
