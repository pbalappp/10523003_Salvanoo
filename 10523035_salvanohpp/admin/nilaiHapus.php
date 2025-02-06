<?php
include "../koneksi/koneksi.php";

if (isset($_GET['nim']) && isset($_GET['nip'])) {
    $nim = $_GET['nim'];
    $nip = $_GET['nip'];

    $queryHapus = "DELETE FROM nilai WHERE nim = '$nim' AND nip = '$nip'";

    if (mysqli_query($koneksi, $queryHapus)) {
        echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data nilai berhasil dihapus.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php'; // Redirect ke halaman index
                    }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './?adm=mahasiswa';
                    }
                });
              </script>";
    }
} else {
    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'NIM atau NIP tidak valid.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = './?adm=mahasiswa';
                }
            });
          </script>";
}
?>

<!-- Tambahkan SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

