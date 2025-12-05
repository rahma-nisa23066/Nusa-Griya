<?php
$conn = mysqli_connect("localhost", "root", "", "nusa_griya");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query ke database
$query = "SELECT * FROM pembayaran";
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil
if (!$result) {
    die("Kesalahan query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Nusa Griya</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        .btn-approve {
            background-color: #2ecc71;
        }

        .btn-decline {
            background-color: #e74c3c;
        }

        .btn-edit {
            background-color: #3498db;
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
        <h1>Kelola Pembayaran</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Dokumen</th>
                    <th>DP</th>
                    <th>Bank</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td><a href='uploads/" . $row["dokumen"] . "' target='_blank'>Lihat Dokumen</a></td>";
                        echo "<td>" . $row["dp"] . "</td>";
                        echo "<td>" . $row["bank"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-edit' data-toggle='modal' data-target='#editModal' 
                                data-id='" . $row["id"] . "' 
                                data-nama='" . htmlspecialchars($row["nama"], ENT_QUOTES) . "' 
                                data-email='" . htmlspecialchars($row["email"], ENT_QUOTES) . "' 
                                data-dp='" . $row["dp"] . "' 
                                data-bank='" . $row["bank"] . "' 
                                data-status='" . $row["status"] . "'>Edit</button>";
                        if ($row["status"] == "Pending") {
                            echo "<a href='?action=approve&id=" . $row["id"] . "' class='btn btn-approve'>Setujui</a> ";
                            echo "<a href='?action=decline&id=" . $row["id"] . "' class='btn btn-decline'>Tolak</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada pembayaran yang tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="update_pembayaran.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">

                        <label for="edit_nama">Nama:</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>

                        <label for="edit_email">Email:</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>

                        <label for="edit_dp">DP:</label>
                        <input type="number" name="dp" id="edit_dp" class="form-control" required>

                        <label for="edit_bank">Bank:</label>
                        <input type="text" name="bank" id="edit_bank" class="form-control" required>

                        <label for="edit_status">Status:</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nama = button.data('nama');
            var email = button.data('email');
            var dp = button.data('dp');
            var bank = button.data('bank');
            var status = button.data('status');

            var modal = $(this);
            modal.find('#edit_id').val(id);
            modal.find('#edit_nama').val(nama);
            modal.find('#edit_email').val(email);
            modal.find('#edit_dp').val(dp);
            modal.find('#edit_bank').val(bank);
            modal.find('#edit_status').val(status);
        });
    </script>
</body>
</html>