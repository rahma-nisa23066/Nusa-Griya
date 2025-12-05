<?php
// Konfigurasi database
$host = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "nusa_griya"; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani form tambah tipe rumah
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'tambah') {
    $judul_rumah = $_POST['judul_rumah'];
    $deskripsi_rumah = $_POST['deskripsi_rumah'];
    $spesifikasi = $_POST['spesifikasi'];
    $harga = $_POST['harga'];


    // Menambahkan tipe rumah baru
    $stmt = $conn->prepare("INSERT INTO tipe_rumah (judul_rumah, deskripsi_rumah, spesifikasi, harga) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $judul_rumah, $deskripsi_rumah, $spesifikasi, $harga,);

    if ($stmt->execute()) {
        echo "Tipe rumah berhasil ditambahkan!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

// Menangani edit tipe rumah
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $judul_rumah = $_POST['judul_rumah'];
    $deskripsi_rumah = $_POST['deskripsi_rumah'];
    $spesifikasi = $_POST['spesifikasi'];
    $harga = $_POST['harga'];
    

    // Update data tipe rumah
    $stmt = $conn->prepare("UPDATE tipe_rumah SET judul_rumah = ?, deskripsi_rumah = ?, spesifikasi = ?, harga = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $judul_rumah, $deskripsi_rumah, $spesifikasi, $harga, $id, $gambar);

    if ($stmt->execute()) {
        echo "Tipe rumah berhasil diperbarui!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

// Menangani hapus tipe rumah
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Hapus tipe rumah
    $stmt = $conn->prepare("DELETE FROM tipe_rumah WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Tipe rumah berhasil dihapus!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

// Ambil data tipe rumah dari database
$result = $conn->query("SELECT * FROM tipe_rumah");

// Periksa apakah tabel ada atau ada data
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
        <h1>Kelola Tipe Rumah</h1>

        <a href="#" class="btn btn-add">Tambah Tipe Rumah</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Rumah</th>
                    <th>Deskripsi Rumah</th>
                    <th>Spesifikasi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['judul_rumah']) ?></td>
                            <td><?= htmlspecialchars($row['deskripsi_rumah']) ?></td>
                            <td><?= htmlspecialchars($row['spesifikasi']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            
                            <td>
                                <a href="?hapus=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Tidak ada data tipe rumah.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php
        // Jika ada parameter 'edit', ambil data tipe rumah untuk ditampilkan pada form
        if (isset($_GET['edit'])) {
            $id_edit = $_GET['edit'];
            $edit_query = $conn->query("SELECT * FROM tipe_rumah WHERE id = $id_edit");
            $edit_data = $edit_query->fetch_assoc();
        ?>
            <div class="form-container">
                <h2>Edit Tipe Rumah</h2>
                <form action="#" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">

                    <label for="judul_rumah">Judul Rumah</label>
                    <input type="text" id="judul_rumah" name="judul_rumah" value="<?= htmlspecialchars($edit_data['judul_rumah']) ?>" required>

                    <label for="deskripsi_rumah">Deskripsi Rumah</label>
                    <input type="text" id="deskripsi_rumah" name="deskripsi_rumah" value="<?= htmlspecialchars($edit_data['deskripsi_rumah']) ?>" required>

                    <label for="spesifikasi">Spesifikasi</label>
                    <textarea id="spesifikasi" name="spesifikasi" rows="4" required><?= htmlspecialchars($edit_data['spesifikasi']) ?></textarea>

                    <label for="harga">Harga</label>
                    <input type="text" id="harga" name="harga" value="<?= htmlspecialchars($edit_data['harga']) ?>" required>

                    <label for="gambar">Gambar</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>

                    <button type="submit">Perbarui</button>
                </form>
            </div>
        <?php } else { ?>
            <div class="form-container">
                <h2>Tambah Tipe Rumah</h2>
                <form action="#" method="POST">
                    <input type="hidden" name="action" value="tambah">
                    <label for="judul_rumah">Judul Rumah</label>
                    <input type="text" id="judul_rumah" name="judul_rumah" required>

                    <label for="deskripsi_rumah">Deskripsi Rumah</label>
                    <input type="text" id="deskripsi_rumah" name="deskripsi_rumah" required>

                    <label for="spesifikasi">Spesifikasi</label>
                    <textarea id="spesifikasi" name="spesifikasi" rows="4" required></textarea>

                    <label for="harga">Harga</label>
                    <input type="text" id="harga" name="harga" required>

                    <label for="gambar">Gambar</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" required>

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
?>