<?php
include "../koneksi/koneksi.php";

$queryNilai = "SELECT 
    m.nim, 
    m.nama, 
    n.nl_tugas, 
    n.nl_uts, 
    n.nl_uas,
    (0.2 * n.nl_tugas) + (0.4 * n.nl_uts) + (0.4 * n.nl_uas) AS nilai_akhir,
    d.nip, 
    d.nama AS nama_dosen
FROM nilai n
LEFT JOIN mahasiswa m ON n.nim = m.nim
LEFT JOIN dosen d ON n.nip = d.nip";

$resultNilai = mysqli_query($koneksi, $queryNilai);
$countNilai = mysqli_num_rows($resultNilai);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="container mt-4">

    <h3 class="text-center text-primary">📊 Data Nilai Mahasiswa</h3>
    <hr/>

    <div class="mb-3">
        <a href="nilaiAdd.php" class="btn btn-success">➕ Tambah Data Nilai</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Dosen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($countNilai > 0) { 
                while ($dataNilai = mysqli_fetch_array($resultNilai, MYSQLI_NUM)) { ?>
                    <tr class="text-center">
                        <td><?= $dataNilai[0]; ?></td>
                        <td><?= $dataNilai[1]; ?></td>
                        <td><?= number_format($dataNilai[2], 2); ?></td>
                        <td><?= number_format($dataNilai[3], 2); ?></td>
                        <td><?= number_format($dataNilai[4], 2); ?></td>
                        <td><strong><?= number_format($dataNilai[5], 2); ?></strong></td>
                        <td><?= $dataNilai[7]; ?></td>
                        <td>
                            <a href="nilaiEdit.php?nim=<?= $dataNilai[0]; ?>&nip=<?= $dataNilai[6]; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('<?= $dataNilai[0]; ?>', '<?= $dataNilai[6]; ?>')">🗑️ Hapus</button>
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="8" class="text-center text-danger">Belum ada Data Mahasiswa</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        function hapusData(nim, nip) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "nilaiHapus.php?nim=" + nim + "&nip=" + nip;
                }
            });
        }
    </script>

</body>
</html>
