<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nusa_griya";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses menghapus data pemesanan
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sqlDelete = "DELETE FROM pemesanan WHERE id = $delete_id";

    if ($conn->query($sqlDelete) === TRUE) {
        echo "<script>alert('Data pemesanan berhasil dihapus!');</script>";
        header("Location: admin_pemesanan.php");
        exit;
    } else {
        echo "Error: " . $sqlDelete . "<br>" . $conn->error;
    }
}

// Proses menyimpan perubahan data (fitur edit)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit_id'])) {
    $edit_id = intval($_POST['edit_id']);
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $price = htmlspecialchars($_POST['price']);
    $houseType = htmlspecialchars($_POST['houseType']);
    $status = htmlspecialchars($_POST['status']);

    $sqlUpdate = "UPDATE pemesanan SET 
        fullName = '$fullName', 
        email = '$email', 
        phone = '$phone', 
        address = '$address', 
        price = '$price', 
        houseType = '$houseType', 
        status = '$status' 
        WHERE id = $edit_id";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "<script>alert('Data pemesanan berhasil diperbarui!');</script>";
        header("Location: admin_pemesanan.php");
        exit;
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
    }
}

// Mendapatkan data pemesanan untuk tabel
$sql = "SELECT * FROM pemesanan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Nusa Griya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
        .content {
            margin-left: 260px;
            padding: 2rem;
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
        <h1>Kelola Pemesanan</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Harga</th>
                    <th>Tipe Rumah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fullName']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['houseType']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo $row['fullName']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['price']; ?>', '<?php echo $row['houseType']; ?>', '<?php echo $row['status']; ?>')">Edit</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Pemesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="edit_id">
                        <div class="mb-3">
                            <label for="edit_fullName" class="form-label">Nama</label>
                            <input type="text" id="edit_fullName" name="fullName" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" id="edit_email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_phone" class="form-label">No. Telepon</label>
                            <input type="tel" id="edit_phone" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_address" class="form-label">Alamat</label>
                            <input type="text" id="edit_address" name="address" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_price" class="form-label">Harga</label>
                            <input type="text" id="edit_price" name="price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_houseType" class="form-label">Tipe Rumah</label>
                            <input type="text" id="edit_houseType" name="houseType" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select id="edit_status" name="status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Declined">Declined</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(id, nama, email, phone, address, price, houseType, status) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_fullName').value = nama;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_address').value = address;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_houseType').value = houseType;
            document.getElementById('edit_status').value = status;
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }
    </script>
</body>
</html>
