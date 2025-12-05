<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Halaman About Us</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kMVqE+gq4hCUQQxElYk2VtkfU4Rl1C5Xk3QzWjlOlq2KMQ6vPHTC8Kmi7XZ08s6e3EfkQH2cF7E0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary: #b6895b;
            --bg: #f4f4f4;
            --white: #fff;
            --gray: #888;
            --black: #333;
            --card-bg: #fff;
            --card-border: #ddd;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: var(--bg);
            color: var(--black);
        }

        .navbar {
            background-color: var(--primary);
            color: var(--white);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar {
            background-color: var(--primary);
            color: var(--white);
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 2rem 1rem;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            color: var(--white);
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            margin-left: 260px;
            padding: 2rem;
        }

        .content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .form-container {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .form-container button:hover {
            background-color: #a57349;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Nusa<span>Griya</span></div>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">Dashboard Utama</a>
        <a href="admin_aboutus.php">Kelola About Us</a>
        <a href="admin_informasi.php">Kelola Informasi</a>
        <a href="admin_pemesanan.php">Kelola Pemesanan</a>
        <a href="admin_pembayaran.php">Kelola Pembayaran</a>
        <a href="admin_tiperumah.php">Kelola Tipe Rumah</a>
        <a href="logout.php">Keluar</a>
    </div>

    <div class="content">
        <h1>Kelola Halaman About Us</h1>

        <div class="form-container">
            <h2>Tentang Kami</h2>
            <form action="admin_aboutus.php" method="POST">
                <label for="tentang_kami">Isi Tentang Kami</label>
                <textarea name="tentang_kami" rows="10" cols="50"><?php echo isset($data['tentang_kami']) ? htmlspecialchars($data['tentang_kami']) : ''; ?></textarea>

                <label for="visi">Isi Visi</label>
                <textarea name="visi" rows="10" cols="50"><?php echo isset($data['visi']) ? htmlspecialchars($data['visi']) : ''; ?></textarea>

                <label for="misi">Isi Misi</label>
                <textarea name="misi" rows="10" cols="50"><?php echo isset($data['misi']) ? htmlspecialchars($data['misi']) : ''; ?></textarea>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and escape the input values
    $tentang_kami = $conn->real_escape_string($_POST['tentang_kami']);
    $visi = $conn->real_escape_string($_POST['visi']);
    $misi = $conn->real_escape_string($_POST['misi']);

    // Perbarui database
    $sql = "UPDATE about_us SET tentang_kami='$tentang_kami', visi='$visi', misi='$misi' WHERE id=1";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data untuk ditampilkan di form
$sql = "SELECT * FROM about_us WHERE id=1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$conn->close();
?>