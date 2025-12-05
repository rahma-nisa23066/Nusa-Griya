<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "nusa_griya";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data tipe rumah dari database
$result = $conn->query("SELECT * FROM tipe_rumah");

// Periksa apakah tabel ada atau ada data
if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tipe Rumah - Nusa Griya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <script src="https://unpkg.com/feather-icons"></script>

    <style>
      :root {
        --primary: #b6895b;
        --bg: #fff;
        --text-color: black;
        --hover-color: #b6895b;
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
        color: var(--text-color);
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

      .tipe-rumah-section {
        padding: 6rem 7% 2rem;
        background-color: var(--bg);
      }

      .tipe-rumah-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #513c28;
        text-align: center;
        margin-bottom: 1rem;
      }

      .filter-section {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
      }

      .filter-section select {
        width: 23%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
      }

      .grid-item {
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .grid-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
      }

      .grid-item h3 {
        padding: 1rem;
        font-size: 1.5rem;
        font-weight: 600;
        color: #513c28;
      }

      .grid-item p {
        padding: 0 1rem;
        font-size: 0.9rem;
        color: #666;
      }

      .grid-item .price {
        padding: 1rem;
        font-weight: 500;
        color: var(--primary);
      }

      .grid-item .detail-btn {
        display: block;
        background-color: var(--primary);
        color: #fff;
        text-align: center;
        padding: 0.8rem;
        text-decoration: none;
        font-weight: 600;
      }

      .grid-item .detail-btn:hover {
        background-color: var(--hover-color);
      }

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

    <header class="hero-section">
      <h1>Tipe Rumah</h1>
    </header>

    <section class="tipe-rumah-section" id="tipe rumah">
      <div class="tipe-rumah-banner"></div>

      <div class="grid-container">
        <div class="grid-item">
          <img src="./gambar/Rumah minimalis 1.jpeg" alt="Rumah Minimalis" />
          <h3>Rumah Minimalis</h3>
          <p>Desain minimalis dengan sentuhan modern yang elegan, cocok untuk keluarga kecil.</p>
          <p class="price">Harga: Rp750.000.000</p>
          <a href="detail-minimalis.html" class="detail-btn">Lihat Detail</a>
        </div>

        <div class="grid-item">
          <img src="./gambar/Rumah modern 1.jpeg" alt="Rumah Mewah" />
          <h3>Rumah Modern</h3>
          <p>Rumah Modern dengan fasilitas lengkap, menawarkan kenyamanan dan memadukan efisiensi desain yang estetis.</p>
          <p class="price">Harga: Rp2.500.000.000</p>
          <a href="detail-modern.html" class="detail-btn">Lihat Detail</a>
        </div>

        <div class="grid-item">
          <img src="./gambar/rumah mewah.jpeg" alt="Rumah Sederhana" />
          <h3>Rumah Mewah</h3>
          <p>Rumah Mewah dengan luas yang besar, fasilitas yang lengkap menawarkan kenyamanan dan kemewahan..</p>
          <p class="price">Harga: Rp5.800.000.000</p>
          <a href="detail-mewah.html" class="detail-btn">Lihat Detail</a>
        </div>
      </div>
    </section>

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