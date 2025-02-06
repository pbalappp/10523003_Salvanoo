<?php
include "../koneksi/koneksi.php";

if (isset($_GET['nim']) && isset($_GET['nip'])) {
    $nim = $_GET['nim'];
    $nip = $_GET['nip'];

    $query = "SELECT * FROM nilai WHERE nim = '$nim' AND nip = '$nip'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='nilaiView.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('NIM atau NIP tidak diterima'); window.location='nilaiView.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nl_tugas = $_POST['nl_tugas'];
    $nl_uts = $_POST['nl_uts'];
    $nl_uas = $_POST['nl_uas'];

    $queryUpdate = "UPDATE nilai SET nl_tugas = '$nl_tugas', nl_uts = '$nl_uts', nl_uas = '$nl_uas'
                    WHERE nim = '$nim' AND nip = '$nip'";

    if (mysqli_query($koneksi, $queryUpdate)) {
        echo "<script>
                alert('Data berhasil diubah!');
                window.location.href = './?adm=mahasiswa';
              </script>";
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
    <title>Edit Data Nilai</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
        input[type="number"] {
            border-radius: 10px;
            padding: 10px;
            transition: 0.3s;
        }
        input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h3 class="text-center text-primary">Edit Data Nilai</h3>
        <hr/>

        <form method="post" action="nilaiEdit.php?nim=<?php echo $nim; ?>&nip=<?php echo $nip; ?>" onsubmit="return confirm('Apakah Anda yakin ingin mengubah data ini?')">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM:</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>" readonly />
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP Dosen:</label>
                <input type="text" class="form-control" name="nip" value="<?php echo $data['nip']; ?>" readonly />
            </div>

            <div class="mb-3">
                <label for="nl_tugas" class="form-label">Nilai Tugas:</label>
                <input type="number" class="form-control" name="nl_tugas" step="0.01" min="0" max="100" value="<?php echo $data['nl_tugas']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="nl_uts" class="form-label">Nilai UTS:</label>
                <input type="number" class="form-control" name="nl_uts" step="0.01" min="0" max="100" value="<?php echo $data['nl_uts']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="nl_uas" class="form-label">Nilai UAS:</label>
                <input type="number" class="form-control" name="nl_uas" step="0.01" min="0" max="100" value="<?php echo $data['nl_uas']; ?>" required />
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-custom">Update</button>
                <a href="./?adm=mahasiswa" class="btn btn-secondary btn-custom">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
