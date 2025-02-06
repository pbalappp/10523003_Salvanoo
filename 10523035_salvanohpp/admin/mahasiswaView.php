<?php
include "../koneksi/koneksi.php";

$queryMhs = "SELECT * FROM mahasiswa";
$resultMhs = mysqli_query($koneksi, $queryMhs);
$countMhs = mysqli_num_rows($resultMhs);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center text-primary">📚 Data Mahasiswa</h2>
    <hr>

    <div class="d-flex justify-content-between mb-3">
        <h5>Total Mahasiswa: <span class="badge bg-info"><?php echo $countMhs; ?></span></h5>
        <a href="mahasiswaAdd.php" class="btn btn-success">➕ Tambah Data</a>
    </div>

    <table id="mahasiswaTable" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jurusan</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($countMhs > 0) {
                while ($dataMhs = mysqli_fetch_array($resultMhs, MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($dataMhs['nim']) . "</td>";
                    echo "<td>" . htmlspecialchars($dataMhs['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($dataMhs['jk']) . "</td>";
                    echo "<td>" . htmlspecialchars($dataMhs['jur']) . "</td>";
                    echo "<td>" . htmlspecialchars($dataMhs['password']) . "</td>";
                    echo "<td>
                            <a href='mahasiswaEdit.php?nim=" . $dataMhs['nim'] . "' class='btn btn-warning btn-sm'>✏️ Edit</a>
                            <button onclick='confirmDelete(\"" . $dataMhs['nim'] . "\")' class='btn btn-danger btn-sm'>🗑️ Hapus</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center text-muted'>Belum ada data mahasiswa</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#mahasiswaTable').DataTable();
    });

    function confirmDelete(nim) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'mahasiswaDelete.php?nim=' + nim;
        }
    }
</script>

</body>
</html>
