<?php

include('../koneksi/koneksi.php'); 

$nim = $_GET["nim"];

$delMhs = "DELETE FROM mahasiswa WHERE nim='$nim'"; 

$resultMhs = mysqli_query($koneksi, $delMhs);

if ($resultMhs) {
    echo "<script>alert('Data Mahasiswa Berhasil Dihapus');</script>";
    echo "<script type='text/javascript'>window.location = './?adm=mahasiswa';</script>";
} else {
    echo "<script>alert('Data Mahasiswa Gagal Dihapus');</script>";
    echo "<script type='text/javascript'>window.location = './?adm=mahasiswa';</script>";
}

?>
