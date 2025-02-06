<?php
include "../koneksi/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nl_tugas = mysqli_real_escape_string($koneksi, $_POST['nl_tugas']);
    $nl_uts = mysqli_real_escape_string($koneksi, $_POST['nl_uts']);
    $nl_uas = mysqli_real_escape_string($koneksi, $_POST['nl_uas']);

    $queryInsert = "INSERT INTO nilai (nim, nip, nl_tugas, nl_uts, nl_uas) 
                    VALUES ('$nim', '$nip', '$nl_tugas', '$nl_uts', '$nl_uas')";

    if (mysqli_query($koneksi, $queryInsert)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = './?adm=mahasiswa';
              </script>";
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
    <title>Tambah Data Nilai</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="number"] {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease-in-out;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
        }
        .btn {
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="text-center text-primary">📊 Tambah Data Nilai</h3>
                <hr>

                <form method="post" action="nilaiAdd.php">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM Mahasiswa</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required />
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP Dosen</label>
                        <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP Dosen" required />
                    </div>

                    <div class="mb-3">
                        <label for="nl_tugas" class="form-label">Nilai Tugas</label>
                        <input type="number" name="nl_tugas" class="form-control" min="0" max="100" step="0.01" placeholder="0 - 100" required />
                    </div>

                    <div class="mb-3">
                        <label for="nl_uts" class="form-label">Nilai UTS</label>
                        <input type="number" name="nl_uts" class="form-control" min="0" max="100" step="0.01" placeholder="0 - 100" required />
                    </div>

                    <div class="mb-3">
                        <label for="nl_uas" class="form-label">Nilai UAS</label>
                        <input type="number" name="nl_uas" class="form-control" min="0" max="100" step="0.01" placeholder="0 - 100" required />
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">✅ Simpan Data</button>
                        <a href="./?adm=mahasiswa" class="btn btn-secondary">🔙 Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
