<?php
include "../koneksi/koneksi.php";

$queryDosen = "SELECT * FROM dosen";
$resultDosen = mysqli_query($koneksi, $queryDosen);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            padding: 20px;
            color: #fff;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: auto;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        h3 {
            color: #333;
            margin-bottom: 20px;
        }
        .buttonadm {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .buttonadm:hover {
            background: #2E7D32;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #333;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #ddd;
        }
        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            margin-right: 5px;
        }
        .btn-edit {
            background: #FFC107;
        }
        .btn-edit:hover {
            background: #FFA000;
        }
        .btn-delete {
            background: #E53935;
        }
        .btn-delete:hover {
            background: #C62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Data Dosen</h3>
        <a href="dosenAdd.php" class="buttonadm">+ Tambah Data Dosen</a>

        <table>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Kode Matkul</th>
                <th>Aksi</th>
            </tr>
            <?php while ($dataDosen = mysqli_fetch_assoc($resultDosen)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($dataDosen['nip']); ?></td>
                    <td><?php echo htmlspecialchars($dataDosen['nama']); ?></td>
                    <td><?php echo htmlspecialchars($dataDosen['kode_mtkul']); ?></td>
                    <td>
                        <a href="dosenEdit.php?nip=<?php echo htmlspecialchars($dataDosen['nip']); ?>" class="btn btn-edit">Edit</a>
                        <a href="dosenHapus.php?nip=<?php echo htmlspecialchars($dataDosen['nip']); ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
