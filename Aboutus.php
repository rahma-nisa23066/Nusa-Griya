<?php
session_start();
?>

<?php
include('koneksi.php');
$result = $conn->query("SELECT * FROM about_us WHERE id = 1");
$row = $result->fetch_assoc();

$tentang_kami = $row['tentang_kami'];
$visi = $row['visi'];
$misi = $row['misi'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - Nusa Griya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

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
        }

        body {
            background-color: var(--bg);
            color: black;
        }

        /* Navbar */
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

        .hero-section {
            margin-top: 90px; /* To offset the navbar height */
            background: linear-gradient(rgba(182, 137, 91, 0.8), rgba(182, 137, 91, 0.8)), url('./gambar/Tipe rumah 1.jpg') center/cover no-repeat;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .welcome-section {
            padding: 100px 7% 50px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .welcome-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #003366;
        }

        .welcome-section p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .mission-vision {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
            flex-wrap: wrap; /* Untuk mendukung responsivitas pada layar kecil */
        }

        .vision, .mission {
            flex: 1; 
            min-width: 250px; 
            max-width: 400px;
            margin: 0 20px;
            background-color: #f1f1f1; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }

        .vision h4, .mission h4 {
            color: #003366; /* Warna judul yang sesuai */
            margin-bottom: 10px; /* Jarak bawah untuk judul */
        }

        /* Footer */
        footer {
            background-color: #003366;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }

        .form-message {
            margin-top: 20px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
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


    <!-- Hero Section -->
    <header class="hero-section">
        <h1>About Us</h1>
    </header>

    <section class="welcome-section">
    <h2>Tentang Kami</h2>
    <p><?php echo $tentang_kami; ?></p>

    <div class="misi-visi">
        <div class="visi">
            <h4>Visi</h4>
            <p><?php echo $visi; ?></p>
        </div>
        <div class="misi">
            <h4>Misi</h4>
            <p><?php echo $misi; ?></p>
        </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background-image: url('/mnt/data/image.png'); background-size: cover; padding: 50px 0; color: #fff;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
            <div class="footer-content" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                <div class="footer-section" style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 15px;">Hubungi Kami</h2>
                    <p style="font-size: 1rem; line-height: 1.6;">Phone</p>
                    <p style="font-size: 1rem; line-height: 1.6;">031-740-2008</p>
                    <p style="font-size: 1rem; line-height: 1.6;">Office Perumahan Nusa Griya. Surabaya. Indonesia</p>
                    <p style="font-size: 1rem; line-height: 1.6;">WhatsApp (Marketing)</p>
                    <p style="font-size: 1rem; line-height: 1.6;">+628165454317</p>
                    <p style="font-size: 1rem; line-height: 1.6;">Email</p>
                    <p style="font-size: 1rem; line-height: 1.6;">info.NusaGriya@gmail.com</p>
                </div>
                <div class="footer-section" style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 15px;">Menu</h2>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="about.html" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Home</a></li>
                        <li><a href="Home.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Home</a></li>
                        <li><a href="About us.html" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">About Us</a></li>
                        <li><a href="Informasi.html" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Informasi</a></li>
                        <li><a href="Tipe Rumah.html" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Tipe Rumah</a></li>
                        <li><a href="pemesanan.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Pemasaran</a></li>
                        <li><a href="Rating.html" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Rate Us</a></li>
                    </ul>
                </div>
                <div class="footer-section" style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 15px;">Others</h2>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="#" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Privacy Policy</a></li>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        feather.replace();
    </script>
        <script>
            document.getElementById("contactForm").addEventListener("submit", function (event) {
                event.preventDefault();
    
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const message = document.getElementById("message").value;
    
                if (name && email && message) {
                    document.getElementById("formMessage").textContent = "Thank you for contacting us, " + name + "! We will respond to your message shortly.";
                    document.getElementById("formMessage").style.color = "green";
                    document.getElementById("contactForm").reset();
                } else {
                    document.getElementById("formMessage").textContent = "Please fill out all fields.";
                    document.getElementById("formMessage").style.color = "red";
                }
            });
        </script>
    </body> 
    </html>