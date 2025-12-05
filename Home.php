<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Nusa Griya</title>

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
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-top: 15px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .welcome-section {
            padding: 50px 0;
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

        .image-section {
            padding: 20px 0;
            text-align: center;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .featured-section {
            padding: 50px 0;
            background-color: #fff;
            text-align: center;
        }

        .featured-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #003366;
        }

        .featured-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .featured-item {
            flex: 1;
            min-width: 250px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .featured-item h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .featured-item p {
            font-size: 1rem;
            color: #666;
        }

        .featured-item a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--primary);
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .featured-item a:hover {
            background-color: #513c28;
        }

        .facilities-section {
            padding: 50px 0;
            background-color: #fff;
            text-align: center;
        }

        .facilities-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #003366;
        }

        .facilities-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .facility-item {
            flex: 1;
            min-width: 250px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .facility-item h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .facility-item p {
            font-size: 1rem;
            color: #666;
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
    <nav class="navbar">
        <a href="#" class="navbar-logo">Nusa<span>Griya</span>.</a>
        <div class="navbar-nav">
            <a href="Home.php" class="active">Home</a>
            <a href="Aboutus.php">About Us</a>
            <a href="Informasi.php">Informasi</a>
            <a href="Tipe Rumah.php">Tipe Rumah</a>
            <a href="pemesanan.php">Pemesanan</a>
            <a href="pembayaran.php">Pembayaran</a>
        </div>
        <div class="navbar-login">
                <span>Welcome, !</span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="pendaftaran.php">Register</a>
        </div>
    </nav>

    <header class="hero-section">
        <h1>Selamat Datang <br>di Nusa Griya</h1>
        <p>Temukan rumah impian Anda bersama kami</p>
    </header>

    <section class="welcome-section">
        <h2>Selamat Datang di Perumahan Nusa Griya</h2>
        <p>
            Nusa Griya adalah pilihan terbaik untuk keluarga Anda. Dengan berbagai tipe rumah dan fasilitas modern, kami memberikan solusi hunian yang nyaman dan aman. 
            Nikmati lingkungan yang tenang dengan akses mudah ke berbagai pusat aktivitas kota.
        </p>
    </section>

    <section class="image-section">
        <div class="image-container">
            <img src="./gambar/foto home.jpeg" alt="Nusa Griya" />
        </div>
    </section>

    <section class="featured-section">
        <h2>Produk Unggulan Kami</h2>
        <div class="featured-container">
            <div class="featured-item">
                <h3>Tipe Rumah Minimalis</h3>
                <p>Rumah minimalis dengan desain modern dan harga terjangkau.</p>
                <a href="detail-minimalis.html">Lihat Detail</a>
            </div>
            <div class="featured-item">
                <h3>Tipe Rumah Modern</h3>
                <p>Rumah luas dengan taman yang indah dan fasilitas lengkap.</p>
                <a href="detail-modern.html">Lihat Detail</a>
            </div>
            <div class="featured-item">
                <h3>Tipe Mewah</h3>
                <p>Rumah mewah dengan desain elegan dan lokasi strategis.</p>
                <a href="detail-mewah.html">Lihat Detail</a>
            </div>
        </div>
    </section>

    <section class="facilities-section">
        <h2>Fasilitas Perumahan Nusa Griya</h2>
        <div class="facilities-container">
            <div class="facility-item">
                <h3>Lapangan Olahraga</h3>
                <p>Tersedia lapangan untuk olahraga seperti bulu tangkis, basket, atau sepak bola, yang dapat digunakan oleh penghuni untuk berolahraga dan bersosialisasi.</p>
            </div>
            <div class="facility-item">
                <h3>Taman Bermain Anak</h3>
                <p>Area bermain yang aman dan menyenangkan untuk anak-anak Anda.</p>
            </div>
            <div class="facility-item">
                <h3>Ruang Serbaguna</h3>
                <p>Ruang multifungsi yang dapat digunakan untuk berbagai acara, seperti pertemuan komunitas, seminar, atau acara keluarga. Fasilitas ini tersedia untuk penghuni dan dapat dipesan sesuai kebutuhan.</p>
            </div>
            <div class="facility-item">
                <h3>Keamanan 24 Jam</h3>
                <p>Keamanan yang handal dengan sistem pengawasan dan petugas keamanan setiap saat.</p>
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
                        <li><a href="pemesanan.php" style="font-size: 1rem; color: #fff; text-decoration: none; line-height: 1.6;">Pemesanan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

