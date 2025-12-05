<?php
// ===========================
// Bagian Backend - Proses Login
// ===========================

// Mulai session
session_start();

// Periksa apakah metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Konfigurasi Database
    $host = 'localhost';
    $dbname = 'nusa_griya';
    $username = 'root';
    $password = '';

    try {
        // Membuat koneksi ke database menggunakan PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Menangani kesalahan koneksi database
        die("Koneksi database gagal: " . $e->getMessage());
    }

    // ===========================
    // Validasi Input Pengguna
    // ===========================

    // Mengamankan input email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $passwordInput = $_POST['password'];

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
        $alertType = "error";
        $message = "Format email tidak valid.";
    } else {
        // Query untuk mencari pengguna berdasarkan email
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password
        if ($user && password_verify($passwordInput, $user['password'])) {
            // Set session data
            $_SESSION['id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            $role = $user['role'];
            $alertType = "success";
            $message = "Selamat datang!";
            $redirectURL = ($role === 'admin') ? 'admin_dashboard.php' : 'home.php';
        } else {
            // Jika email atau password salah
            $alertType = "error";
            $message = "Email atau password salah.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- ===========================
    Bagian Head - Metadata dan CSS
    =========================== -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Log In - Nusa Griya</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS -->
    <style>
        :root {
            --primary: #b6895b;
            --bg: #fff;
        }

        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            background-color: var(--bg);
            color: black;
        }

        /* ===========================
        Bagian Navbar
        =========================== */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.4rem 7%;
            background-color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid #513c28;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        .navbar .navbar-logo {
            font-size: 2rem;
            font-weight: 700;
            color: #513c28;
            font-style: italic;
        }

        .navbar .navbar-logo span {
            color: var(--primary);
        }

        .navbar .navbar-nav a {
            color: black;
            display: inline-block;
            font-size: 1rem;
            margin: 0 1rem;
        }

        .navbar .navbar-nav a:hover {
            color: var(--primary);
        }

        .navbar .navbar-extra a {
            color: black;
            margin: 0 0.5rem;
        }

        .navbar .navbar-extra a:hover {
            color: var(--primary);
        }

        #menu {
            display: none;
        }

        .navbar-login {
            display: flex;
            align-items: center;
        }

        .navbar-login span {
            margin-right: 10px;
        }

        .navbar-login a {
            margin-left: 10px;
        }

        /* ===========================
        Bagian Hero Section
        =========================== */
        .hero-section {
            margin-top: 90px; 
            background: linear-gradient(rgba(182, 137, 91, 0.8), rgba(182, 137, 91, 0.8)), url('./gambar/Tipe rumah 1.jpg') center/cover no-repeat;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        /* ===========================
        Bagian Form Login
        =========================== */
        .form-container {
            margin-top: 100px;
            padding: 40px 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-container h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin: 15px 0 5px;
            color: #555;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            font-size: 16px;
            color: #fff;
            background-color: var(--primary);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        footer {
            background-color: #003366;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- ===========================
    Bagian Navbar
    =========================== -->
     <!-- Navbar start -->
<nav class="navbar">
    <a href="Home.php" class="navbar-logo">Nusa<span>Griya</span>.</a>
    <div class="navbar-nav">
        <a href="Home.php" class="active">Home</a>
        <a href="Aboutus.php">About Us</a>
        <a href="Informasi.php">Informasi</a>
        <a href="TipeRumah.php">Tipe Rumah</a>
        <a href="pemesanan.php">Pemesanan</a>
        <a href="pembayaran.php">Pembayaran</a>
    </div>

    <!-- Navbar Login Section -->
    <div class="navbar-login">
        <?php if (isset($_SESSION['id'])): ?>
            <span>Welcome, <?php echo $_SESSION['full_name']; ?>!</span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="pendaftaran.php">Register</a>
        <?php endif; ?>
    </div>
</nav>
<!-- Navbar end -->

    <!-- ===========================
    Bagian Hero Section
    =========================== -->
    <header class="hero-section">
        <h1>Halaman Login</h1>
    </header>

    <!-- ===========================
    Bagian Form Login
    =========================== -->
    <main>
        <div class="form-container">
            <h2>Login</h2>
            <form id="loginForm" action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
                <button type="submit">Login</button>
            </form>
        </div>
    </main>

    <!-- ===========================
    Bagian SweetAlert
    =========================== -->
    <script>
        <?php if (isset($alertType)): ?>
            Swal.fire({
                title: "<?= $alertType === 'success' ? 'Login Berhasil' : 'Login Gagal' ?>",
                text: "<?= $message ?>",
                icon: "<?= $alertType ?>",
                confirmButtonText: "OK"
            }).then(function() {
                <?php if ($alertType === 'success'): ?>
                    window.location.href = "<?= $redirectURL ?>";
                <?php else: ?>
                    document.getElementById('loginForm').reset();
                <?php endif; ?>
            });
        <?php endif; ?>
    </script>

</body>
</html>
