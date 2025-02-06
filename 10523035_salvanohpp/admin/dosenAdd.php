<?php
include "../koneksi/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kode_mtkul = mysqli_real_escape_string($koneksi, $_POST['kode_mtkul']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    $queryAdd = "INSERT INTO dosen (nip, nama, kode_mtkul, password) 
                 VALUES ('$nip', '$nama', '$kode_mtkul', '$password')";

    if (mysqli_query($koneksi, $queryAdd)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='./?adm=dosenView';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            text-align: center;
        }
        h3 {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"], button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        button {
            background-color: #dc3545;
            color: white;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Tambah Data Dosen</h3>
        <hr/>
        <form method="post" action="dosenAdd.php">
            <label for="nip">NIP:</label>
            <input type="text" name="nip" required />
            
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required />
            
            <label for="kode_mtkul">Kode Mata Kuliah:</label>
            <input type="text" name="kode_mtkul" required />
            
            <label for="password">Password:</label>
            <input type="password" name="password" required />
            
            <input type="submit" value="Tambah" />
            <a href="./?adm=dosenView"><button type="button">Kembali</button></a>
        </form>
    </div>
</body>
</html>
