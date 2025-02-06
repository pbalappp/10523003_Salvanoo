<?php
include "../koneksi/koneksi.php";

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Gunakan prepared statement untuk keamanan
    $queryDelete = "DELETE FROM dosen WHERE nip = ?";
    $stmt = mysqli_prepare($koneksi, $queryDelete);
    mysqli_stmt_bind_param($stmt, "s", $nip);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location='./?adm=mahasiswa';
              </script>";
    } else {
        echo "<script>alert('Gagal menghapus data, coba lagi!');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }
        p {
            color: #555;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-danger {
            background: #e74c3c;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .btn-cancel {
            background: #3498db;
        }
        .btn-cancel:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus data dosen dengan NIP <strong><?php echo htmlspecialchars($nip); ?></strong>?</p>
        <a href="?nip=<?php echo htmlspecialchars($nip); ?>&confirm=yes" class="btn btn-danger">Ya, Hapus</a>
        <a href="./?adm=mahasiswa" class="btn btn-cancel">Batal</a>
    </div>
</body>
</html>
