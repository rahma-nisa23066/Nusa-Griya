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

        .cards {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            text-align: center;
        }

        .card i {
            font-size: 3rem;
            color: var(--primary);
        }

        .card .title {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 1rem 0;
        }

        .card .value {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .table-container {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        .btn:hover {
            opacity: 0.8;
        }

    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">Nusa<span>Griya</span></div>
        <div class="user">
            <span>Admin</span>
        </div>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">Dashboard Utama</a>
        <a href="admin_aboutus.php">Kelola About Us</a>
        <a href="admin_informasi.php">Kelola Informasi</a>
        <a href="admin_pemesanan.php">Kelola Pemesanan</a>
        <a href="admin_pembayaran.php">Kelola Pembayaran</a>
        <a href="admin_tiperumah.php">Kelola Tipe Rumah</a>
        <a href="logoout.php">Keluar</a>
    </div>

    <div class="content">
        <h1>Dashboard Utama</h1>

        <div class="cards">
            <div class="card">
                <i class="fas fa-home"></i>
                <div class="title">Tipe Rumah</div>
                <div class="value">12</div>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <div class="title">Pemesanan</div>
                <div class="value">58</div>
            </div>
            <div class="card">
                <i class="fas fa-credit-card"></i>
                <div class="title">Pembayaran</div>
                <div class="value">Rp 1,350,000,000</div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="table-container">
            <h2>Pemesanan Terbaru</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pemesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Tipe Rumah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>101</td>
                        <td>John Doe</td>
                        <td>Rumah Tipe 36</td>
                        <td>Menunggu Pembayaran</td>
                        <td>
                            <a href="#" class="btn btn-edit">Lihat</a>
                            <a href="#" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Jane Smith</td>
                        <td>Rumah Tipe 45</td>
                        <td>Diproses</td>
                        <td>
                            <a href="#" class="btn btn-edit">Lihat</a>
                            <a href="#" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
