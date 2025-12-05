<?php
session_start();
?>
<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "nusa_griya";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $houseType = htmlspecialchars($_POST['houseType']);
    $price = htmlspecialchars($_POST['price']);
    $uploadedFile = $_FILES['document'];

    // Menyimpan data pemesanan ke database
    $sql = "INSERT INTO pemesanan (fullName, email, phone, address, houseType, price, document) 
    VALUES ('$fullName', '$email', '$phone', '$address', '$houseType', '$price', '$address')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registrasi berhasil!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Upload file
    $allowedExtensions = ['pdf', 'jpg', 'png'];
    $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

    if (in_array($fileExtension, $allowedExtensions)) {
        $uploadDir = 'uploads/';
        $uploadFilePath = $uploadDir . basename($uploadedFile['name']);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
            echo "<script>alert('Pemesanan berhasil dikirim! File berhasil diunggah.');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file.');</script>";
        }
    } else {
        echo "<script>alert('Format file tidak valid. Hanya file PDF, JPG, dan PNG yang diperbolehkan.');</script>";
    }
}

// Mengambil data pengguna dari database berdasarkan session ID
$user_id = $_SESSION['id'] ?? null;

if ($user_id) {
    $sql = "SELECT full_name, email, phone_number, address FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data pengguna dari database
        $user = $result->fetch_assoc();
        $fullName = $user['full_name'];
        $email = $user['email'];
        $phone = $user['phone_number'];
        $address = $user['address'];
    } else {
        // Jika data pengguna tidak ditemukan
        $fullName = $email = $phone = $address = '';
    }
} else {
    // Jika session ID tidak ada (belum login)
    $fullName = $email = $phone = $address = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan - Nusa Griya</title>

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

        .pemesanan {
            padding: 50px 0;
            background-color: #f9f9f9;
            text-align: center;
        }

        .pemesanan h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #003366;
        }

        .pemesanan p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            text-align: left;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #b6895b;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        td input[type="text"],
        td input[type="email"],
        td input[type="tel"],
        td select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        td input[type="text"]:focus,
        td input[type="email"]:focus,
        td input[type="tel"]:focus,
        td select:focus {
            border-color: #b6895b;
            outline: none;
        }

        button[type="submit"] {
            display: inline-block;
            background-color: #b6895b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #513c28;
        }

        .download-link {
            font-size: 1.2rem;
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
            padding: 10px 15px;
            border: 2px solid var(--primary);
            border-radius: 2px;
        }

        .download-link:hover {
            background-color: var(--primary);
            color: white;
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

    <header class="hero-section">
        <h1>Pemesanan</h1>
    </header>

    <section class="pemesanan">
        <h2>Formulir Pemesanan</h2>
        <p>Silakan download formulir terlebih dahulu, kemudian isi dan kirimkan kembali formulir tersebut.</p>
        
        <a href="https://docs.google.com/document/d/19A2wvlOwcHTbsq-UIGQmtOwSB4DuiW-i/edit?usp=sharing&ouid=117365415713264748895&rtpof=true&sd=true" class="download-link" download>Download Formulir Pemesanan</a>

        <p>Setelah mendownload formulir, Anda dapat mengisi formulir di bawah ini:</p>

        <form action="pemesanan.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Nama Lengkap</th>
                    <td><input type="text" id="fullName" name="fullName" value="<?php echo $fullName; ?>" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" id="email" name="email" value="<?php echo $email; ?>" required></td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td><input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><input type="text" id="address" name="address" value="<?php echo $address; ?>" required></td>
                </tr>
                <tr>
                    <th>Tipe Rumah</th>
                    <td>
                        <select id="houseType" name="houseType" required onchange="updatePrice()">
                            <option value="">Pilih Tipe Rumah</option>
                            <option value="Minimalis" <?php echo (isset($houseType) && $houseType === 'Minimalis') ? 'selected' : ''; ?>>Minimalis</option>
                            <option value="Modern" <?php echo (isset($houseType) && $houseType === 'Modern') ? 'selected' : ''; ?>>Modern</option>
                            <option value="Mewah" <?php echo (isset($houseType) && $houseType === 'Mewah') ? 'selected' : ''; ?>>Mewah</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td><select id="price" name="price" required></select></td>
                </tr>
                <tr>
                    <th>Upload Dokumen Formulir</th>
                    <td><input type="file" id="document" name="document" accept=".pdf,.jpg,.png" required></td>
                </tr>
            </table>
            <button type="submit">Kirim Pemesanan</button>
        </form>
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

    <script>
        feather.replace();
        updatePrice();  

        function updatePrice() {
            var houseType = document.getElementById('houseType').value;
            var priceSelect = document.getElementById('price');
            var priceInfo = document.getElementById('priceInfo');

            priceSelect.innerHTML = '';

            if (houseType === 'Minimalis') {
                var option = document.createElement('option');
                option.value = '300000000';
                option.textContent = 'Rp 300.000.000';
                priceSelect.appendChild(option);
                priceInfo.textContent = 'Harga untuk tipe rumah Minimalis';
            } else if (houseType === 'Modern') {
                var option = document.createElement('option');
                option.value = '500000000';
                option.textContent = 'Rp 500.000.000';
                priceSelect.appendChild(option);
                priceInfo.textContent = 'Harga untuk tipe rumah Modern';
            } else if (houseType === 'Mewah') {
                var option = document.createElement('option');
                option.value = '1000000000';
                option.textContent = 'Rp 1.000.000.000';
                priceSelect.appendChild(option);
                priceInfo.textContent = 'Harga untuk tipe rumah Mewah';
            }
        }
    </script>
</body>

</html>
