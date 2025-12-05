<?php

$host = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nusa_griya"; 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani form tambah tipe rumah
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] && $_POST['action'] && $_POST['action']=== 'tambah') {
    $judul_berita = $_POST['judul_berita'];
    $deskripsi_berita = $_POST['deskripsi_berita'];
    $tanggal = $_POST['tanggal'];


    // Menambahkan tipe rumah baru
    $stmt = $conn->prepare("INSERT INTO berita (judul_berita, deskripsi_berita, tanggal) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $judul_berita, $deskripsi_berita, $tanggal);

    if ($stmt->execute()) {
        echo "Berita berhasil ditambahkan!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Hapus tipe rumah
    $stmt = $conn->prepare("DELETE FROM berita WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Berita berhasil dihapus!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

// Ambil data tipe rumah dari database
$result = $conn->query("SELECT * FROM berita");

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Nusa Griya</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kMVqE+gq4hCUQQxElYk2VtkfU4Rl1C5Xk3QzWjlOlq2KMQ6vPHTC8Kmi7XZ08s6e3EfkQH2cF7E0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary: #b6895b;
            --bg: #f4f4f4;
            --white: #fff;
            --gray: #888;
            --black: #333;
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

        .navbar .logo span {
            color: var(--white);
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        table th, table td {
            padding: 1rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            color: var(--white);
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .btn-edit {
            background-color: #3498db;
        }

        .btn-delete {
            background-color: #e74c3c;
        }

        .btn-add {
            background-color: #2ecc71;
            margin-bottom: 1rem;
        }

        .btn:hover {
            opacity: 0.8;
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
        <h1>Kelola Berita & Promo</h1>

        <a href="#" class="btn btn-add">Tambah Berita</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Berita</th>
                    <th>Deskripsi Berita</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['judul_berita']) ?></td>
                            <td><?= htmlspecialchars($row['deskripsi_berita']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal']) ?></td>
                            
                            <td>
                                <a href="?hapus=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Tidak ada data Berita.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php
        // Jika ada parameter 'edit', ambil data tipe rumah untuk ditampilkan pada form
        if (isset($_GET['edit'])) {
            $id_edit = $_GET['edit'];
            $edit_query = $conn->query("SELECT * FROM berita WHERE id = $id_edit");
            $edit_data = $edit_query->fetch_assoc();
        ?>
            <div class="form-container">
                <h2>Edit Tipe Rumah</h2>
                <form action="#" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">

                    <label for="judul_rumah">Judul Berita</label>
                    <input type="text" id="judul_rumah" name="judul_rumah" value="<?= htmlspecialchars($edit_data['judul_berita']) ?>" required>

                    <label for="deskripsi_rumah">Deskripsi Rumah</label>
                    <input type="text" id="deskripsi_rumah" name="deskripsi_rumah" value="<?= htmlspecialchars($edit_data['deskripsi_berita']) ?>" required>

                    <label for="tanggal">tanggal</label>
                    <input type="date" name="tanggal" rows="4" required><?= htmlspecialchars($edit_data['tanggal']) ?></t>

                    <button type="submit">Perbarui</button>
                </form>
            </div>
        <?php } else { ?>
            <div class="form-container">
                <h2>Tambah Berita</h2>
                <form action="#" method="POST">
                    <input type="hidden" name="action" value="tambah">
                    <label for="judul_berita">Judul Berita</label>
                    <input type="text" id="judul_berita" name="judul_berita" required>

                    <label for="deskripsi_berita">Deskripsi Berita</label>
                    <input type="text" id="deskripsi_berita" name="deskripsi_berita" required>

                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" rows="4" required></input>

                    <button type="submit">Simpan</button>
                </form>
            </div>
        <?php } ?>

    </div>
</body>
</html>

<?php
// Menutup koneksi setelah proses selesai
$conn->close();