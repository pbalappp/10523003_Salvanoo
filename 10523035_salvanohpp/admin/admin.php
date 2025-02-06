<?php
include '../koneksi/koneksi.php';

// Pastikan koneksi ke database berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $nama = trim($_POST['nama']);

    // Validasi panjang username & password
    if (strlen($username) < 5) {
        $error = "Username minimal 5 karakter!";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        // Escape input untuk keamanan
        $username = mysqli_real_escape_string($koneksi, $username);
        $nama = mysqli_real_escape_string($koneksi, $nama);

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // **Cek apakah username sudah ada di database**
        $cek_query = "SELECT * FROM admin WHERE username = ?";
        $cek_stmt = mysqli_prepare($koneksi, $cek_query);

        if (!$cek_stmt) {
            die("Query error (Cek username): " . mysqli_error($koneksi));
        }

        mysqli_stmt_bind_param($cek_stmt, "s", $username);
        mysqli_stmt_execute($cek_stmt);
        mysqli_stmt_store_result($cek_stmt);

        if (mysqli_stmt_num_rows($cek_stmt) > 0) {
            $error = "Username sudah digunakan, pilih username lain!";
        } else {
            // **Siapkan query INSERT**
            $query = "INSERT INTO admin (username, password, nama) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);

            if (!$stmt) {
                die("Query error (Insert): " . mysqli_error($koneksi));
            }

            mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $nama);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
                exit;
            } else {
                $error = "Registrasi gagal, silakan coba lagi!";
            }

            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_close($cek_stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
            background: linear-gradient(90deg, #2980b9, #8e44ad);
            -webkit-background-clip: text;
            color: transparent;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }
        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #2980b9;
        }
        .link-container {
            text-align: center;
            margin-top: 20px;
        }
        .link-container a {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }
        .link-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrasi Admin</h2>
        <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required minlength="5">
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required minlength="6">
            
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>
            
            <button type="submit" name="register">Registrasi</button>
        </form>
        <div class="link-container">
            <p>Sudah punya akun? <a href="login.php">Klik di sini untuk login</a></p>
        </div>
    </div>
</body>
</html>
