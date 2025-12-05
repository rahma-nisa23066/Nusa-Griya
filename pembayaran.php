<?php
session_start();
?>
<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "nusa_griya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama'];
    $email = $_POST['email'];
    $dokumen = $_FILES['dokumen']['name'];
    $dp = $_POST['dp'];
    $bank = $_POST['bank'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["dokumen"]["name"]);
    move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file);

    $sql = "INSERT INTO pembayaran (nama, email, dokumen, dp, bank) VALUES ('$nama_lengkap', '$email', '$dokumen', '$dp', '$bank')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='container'>";
        echo "<h1>Konfirmasi Pembayaran</h1>";
        echo "<p>Nama: $nama_lengkap</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Dokumen Formulir: <a href='$target_file' target='_blank'>Lihat Dokumen</a></p>";
        echo "<p>Uang Muka (DP): $dp</p>";
        echo "<p>Pilih Transfer Bank: $bank</p>";
        echo "<p>Data telah berhasil disimpan ke dalam database.</p>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran - Nusa Griya</title>

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

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select,
        input[type="file"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
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

    <div class="container">
        <header class="hero-section">
            <h1>Pembayaran Nusa Griya</h1>
        </header>

        <form method="POST" action="pembayaran.php" enctype="multipart/form-data">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>

            <label for="dokumen">Dokumen Formulir (PDF, JPG, PNG)</label>
            <input type="file" id="dokumen" name="dokumen" accept=".pdf,.jpg,.png" required>

            <label for="dp">Pembayaran DP (Uang Muka)</label>
            <input type="text" id="dp" name="dp" required placeholder="Masukkan jumlah uang muka">

            <label for="bank">Pilih Bank Transfer</label>
            <select id="bank" name="bank" required>
                <option value="" disabled selected>-- Pilih Bank --</option>
                <option value="Bank BCA">Bank BCA</option>
                <option value="Bank Mandiri">Bank Mandiri</option>
                <option value="Bank BRI">Bank BRI</option>
                <option value="Bank BNI">Bank BNI</option>
                <option value="Bank CIMB Niaga">Bank CIMB Niaga</option>
                <option value="Bank Danamon">Bank Danamon</option>
                <option value="Bank BTN">Bank BTN</option>
                <option value="Bank Maybank">Bank Maybank</option>
                <option value="Bank OCBC NISP">Bank OCBC NISP</option>
                <option value="Bank Permata">Bank Permata</option>
                <option value="Bank HSBC">Bank HSBC</option>
                <option value="Bank Citibank">Bank Citibank</option>
                <option value="Bank UOB">Bank UOB</option>
                <option value="Bank BSI">Bank BSI</option>
            </select>

            <input type="submit" value="Bayar Sekarang">
        </form>
    </div>

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
</body>
</html>
