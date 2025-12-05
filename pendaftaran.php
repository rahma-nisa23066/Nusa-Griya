<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "nusa_griya"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";
$status = "";
$form_reset = "false"; // Variable untuk reset form jika email sudah terdaftar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Cek apakah email sudah terdaftar
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($emailCheckQuery);
    
    if ($result->num_rows > 0) {
        // Jika email sudah ada, tampilkan error
        $message = "Email sudah terdaftar!";
        $status = "error";
        $form_reset = "true"; // Menandakan form harus direset
    } else {
        // Jika email belum terdaftar, lanjutkan proses registrasi
        $sql = "INSERT INTO users (full_name, email, password, phone_number, address, role) 
                VALUES ('$full_name', '$email', '$password', '$phone_number', '$address', '$role')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Registrasi berhasil!";
            $status = "success";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
            $status = "error";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran - Nusa Griya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .form-container h1 {
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

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-container input:focus, .form-container textarea:focus {
            border-color: #007bff;
        }

        .form-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
        background-color: #fff;
        }

        .form-container select:focus {
        border-color: #007bff;
        }

        .form-container select:required:invalid {
        color: gray;
        }

        .form-container select option {
        color: black;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            font-size: 16px;
            text-align: center;
            color: #fff;
            background-color: var(--primary);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #513c28;
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
        <h1>Pendaftaran</h1>
    </header>

    <div class="form-container">
        <h1>Form Registrasi</h1>
        <form method="POST" action="">
            <label for="full_name">Nama Lengkap:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="password">Password:</label>
            <div style="position: relative;">
                <input type="password" id="password" name="password" required 
                style="padding-right: 40px; width: 100%; box-sizing: border-box;">
                <button type="button" id="togglePassword" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); 
                    background: none; border: none; cursor: pointer;">
                    <i data-feather="eye"></i>
                </button>
            </div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone_number">Nomor Telepon:</label>
            <input type="text" id="phone_number" name="phone_number">

            <label for="address">Alamat:</label>
            <textarea id="address" name="address"></textarea>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Daftar</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <p>Sudah punya akun?</p>
            <a href="login.php">
                <button style="background-color: #003366; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Login</button>
            </a>
        </div>
    </div>

    <footer>
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
            </div>
        </div>
    </footer>

    <script>
        const passwordField = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');
        const toggleIcon = togglePasswordButton.querySelector('i');

        togglePasswordButton.addEventListener('click', () => {
            const isPasswordVisible = passwordField.type === 'text';
            passwordField.type = isPasswordVisible ? 'password' : 'text';
            toggleIcon.dataset.feather = isPasswordVisible ? 'eye' : 'eye-off';
            feather.replace();
        });

        <?php if (!empty($message)) : ?>
            if ('<?php echo $status; ?>' === 'success') {
                Swal.fire({
                    icon: '<?php echo $status; ?>',
                    title: '<?php echo $message; ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'Klik untuk login',
                    confirmButtonColor: '#28a745',  // Hijau untuk tombol login
                    showCloseButton: false,  // Menghapus tombol tutup
                }).then(() => {
                    window.location.href = 'login.php'; // Alihkan setelah klik tombol
                });
            } else {
                Swal.fire({
                    icon: '<?php echo $status; ?>',
                    title: '<?php echo $message; ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup',
                    showCloseButton: false,  // Menghapus tombol tutup
                }).then(() => {
                    // Kosongkan form jika email sudah terdaftar
                    document.querySelector('form').reset();
                });
            }
        <?php endif; ?>
    </script>

</body>
</html>
