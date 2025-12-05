<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Informasi - Nusa Griya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <script src="https://unpkg.com/feather-icons"></script>

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
            margin-top: 90px;
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

        .info-section {
            padding: 80px 7% 50px;
            background-color: #f9f9f9;
        }

        .info-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #b6895b;
            text-align: center;
        }

        .info-section .info-category {
            margin-bottom: 40px;
        }

        .info-section .info-category h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #513c28;
        }

        .info-section .info-category p {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .promo-section {
            background-color: var(--primary);
            color: #fff;
            padding: 60px 7%;
            text-align: center;
        }

        .promo-section h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .promo-cards {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .promo-card {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 12px;
            width: 300px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .promo-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .promo-card h3 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .promo-card p {
            font-size: 1rem;
            line-height: 1.6;
        }

        .promo-card i {
            width: 50px;
            height: 50px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        footer {
            background-color: #003366;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .promo-cards {
                flex-direction: column;
                align-items: center;
            }

            .promo-card {
                width: 100%;
            }
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

    <header class="hero-section">
        <h1>Informasi Nusa Griya</h1>
    </header>

<section class="kabar-terbaru-section">
    <h2>Kabar Terbaru - Berita & Update</h2>

    <div class="kabar-card">
        <div class="kabar-card-item">
            <img src="./gambar/Peluncuran Clusture.jpg" alt="Peluncuran Cluster Griya Harmoni">
            <h3>Peluncuran Cluster Nusa Griya </h3>
            <p>Cluster terbaru dengan desain modern dan harga terjangkau, cocok untuk keluarga muda yang menginginkan hunian nyaman di lingkungan hijau.</p>
            <a href="detail-artikel 1.html" class="read-more">Selengkapnya <i data-feather="arrow-right"></i></a>
        </div>

        <div class="kabar-card-item">
            <img src="./gambar/Diskon.jpg" alt="Diskon Spesial Oktober 2024">
            <h3>Diskon Spesial Oktober 2024</h3>
            <p>Nikmati penawaran menarik berupa diskon hingga 20% untuk pembelian rumah tipe apa saja di Nusa Griya sepanjang bulan Oktober ini!</p>
            <a href="detail-artikel 2.html" class="read-more">Selengkapnya <i data-feather="arrow-right"></i></a>
        </div>

        <div class="kabar-card-item">
            <img src="./gambar/Buka bersama.jpeg" alt="Acara Buka Bersama Komunitas Warga">
            <h3>Acara Buka Bersama Komunitas Warga</h3>
            <p>Nusa Griya mengadakan acara buka puasa bersama untuk mempererat silaturahmi antara warga. Pastikan Anda hadir pada acara yang penuh keceriaan ini!</p>
            <a href="detail-artikel 3.html" class="read-more">Selengkapnya <i data-feather="arrow-right"></i></a>
        </div>
    </div>
</section>

<style>
    .kabar-terbaru-section {
        padding: 50px 7%;
        background-color: #f0e6db;
        text-align: center;
    }

    .kabar-terbaru-section h2 {
        font-size: 2.5rem;
        margin-bottom: 40px;
        color: #b6895b;
        letter-spacing: 1px;
    }

    .kabar-card {
        display: flex;
        gap: 30px;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .kabar-card-item {
        background-color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        text-align: left;
        flex: 1;
        min-width: 250px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .kabar-card-item:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .kabar-card-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .kabar-card-item h3 {
        color: #513c28;
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    .kabar-card-item p {
        font-size: 1rem;
        color: #333;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .read-more {
        color: var(--primary);
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .read-more i {
        margin-left: 5px;
        width: 16px;
        height: 16px;
    }

    .read-more:hover {
        color: #513c28;
    }

    @media (max-width: 768px) {
        .kabar-card {
            flex-direction: column;
            align-items: center;
        }

        .kabar-card-item {
            width: 100%;
        }
    }
</style>
    
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
                        <li><a href="Home.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Home</a></li>
                        <li><a href="About us.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">About Us</a></li>
                        <li><a href="Informasi.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Informasi</a></li>
                        <li><a href="Tipe Rumah.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Tipe Rumah</a></li>
                        <li><a href="pemesanan.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Pemesanan</a></li>
                        <li><a href="pembayaran.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Pembayaran</a></li>
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