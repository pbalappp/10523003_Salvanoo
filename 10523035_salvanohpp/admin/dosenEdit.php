<?php
include "../koneksi/koneksi.php";

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];
    $query = "SELECT * FROM dosen WHERE nip = '$nip'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    
    if (!$data) {
        echo "<script>alert('Data dosen tidak ditemukan'); window.location='dosenView.php';</script>";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kode_mtkul = mysqli_real_escape_string($koneksi, $_POST['kode_mtkul']);
    $password = $_POST['password'] ? md5($_POST['password']) : $data['password'];
    
    $queryUpdate = "UPDATE dosen SET nama = '$nama', kode_mtkul = '$kode_mtkul', password = '$password' WHERE nip = '$nip'";
    
    if (mysqli_query($koneksi, $queryUpdate)) {
        echo "<script>alert('Data berhasil diubah'); window.location='./?adm=dosenView';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
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
            background-color: #ffc107;
            color: black;
        }
        input[type="submit"]:hover {
            background-color: #e0a800;
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
        <h3>Edit Data Dosen</h3>
        <hr/>
        <form method="post" action="dosenEdit.php?nip=<?php echo $nip; ?>">
            <label for="nip">NIP:</label>
            <input type="text" name="nip" value="<?php echo $data['nip']; ?>" readonly />
            
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required />
            
            <label for="kode_mtkul">Kode Mata Kuliah:</label>
            <input type="text" name="kode_mtkul" value="<?php echo $data['kode_mtkul']; ?>" required />
            
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" />
            
            <input type="submit" value="Update" />
            <a href="./?adm=dosenView"><button type="button">Kembali</button></a>
        </form>
    </div>
</body>
</html>
