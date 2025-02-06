<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include '../koneksi/koneksi.php';

if (isset($_SESSION['admin'])) {
    header('Location: ./?adm=mahasiswa');
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        if (password_verify($password, $data['password'])) {
            $_SESSION['admin'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            session_regenerate_id(true);
            header('Location: ./?adm=mahasiswa');
            exit;
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            position: relative;
            min-height: 100vh;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
        }
        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            position: relative;
        }
        label {
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color:#007BFF;
        }
        .back-link {
            font-size: 18px;
            background-color: transparent;
            color: #007BFF;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .back-link::before {
            content: "←";  
            font-size: 22px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="login">Login</button>

        <button class="back-link" onclick="window.location.href='admin.php'"></button>
    </form>
    <footer>


</body>
</html>
