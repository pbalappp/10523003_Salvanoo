<?php
session_start();

// Cek apakah admin sudah login, jika belum arahkan ke login.php
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistem Informasi Nilai</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/logoicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #2196F3, #1565C0);
            color: white;
            padding: 20px;
        }
        .container {
            background: white;
            color: black;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            max-width: 1000px;
            margin: auto;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        h1 {
            color: #1565C0;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #1565C0;
            color: white;
            border-radius: 12px 12px 0 0;
        }
        .header img {
            height: 50px;
        }
        .menu {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-top: 20px;
            background: #1976D2;
            border-radius: 8px;
            padding: 12px 0;
        }
        .menu li {
            margin: 0 15px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }
        .menu a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
            margin-top: 20px;
        }
        .btn {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            background: #E53935;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #C62828;
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #1565C0;
            border-radius: 0 0 12px 12px;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="../images/logo.png" alt="Logo">
            <h2>Sistem Informasi Nilai Online</h2>
            <a href="logout.php" class="btn" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>

        <!-- Navigation -->
        <ul class="menu">
            <li><a href="./?adm=home">🏠 Home</a></li>
            <li><a href="./?adm=mahasiswa">👨‍🎓 Mahasiswa</a></li>
            <li><a href="./?adm=dosen">👨‍🏫 Dosen</a></li>
            <li><a href="./?adm=nilai">📊 Nilai</a></li>
        </ul>

        <!-- Content -->
        <div class="content">
            <?php
            if (empty($_GET)) {
                include("home.php");
            } else {
                $adm = isset($_GET["adm"]) ? htmlspecialchars($_GET["adm"]) : '';

                if ($adm == "home") {
                    include("home.php");
                } elseif ($adm == "mahasiswa") {
                    include("mahasiswaView.php");
                } elseif ($adm == "mahasiswaAdd") {
                    include("mahasiswaAdd.php");
                } elseif ($adm == "nilai") {
                    include("nilaiView.php");
                } elseif ($adm == "dosen") {
                    include("dosenView.php");
                }
            }
            ?>
        </div>

        <!-- Footer -->
        <footer>
            &copy; 2024 - Sistem Informasi Nilai Online | <a href="biodata.php" style="color: white; text-decoration: underline;">Salvano Hasbie Putra</a>
        </footer>
    </div>
</body>
</html>
