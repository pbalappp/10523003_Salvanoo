<?php
$host = "localhost"; // atau "127.0.0.1"
$user = "root"; // Ubah jika ada username lain
$pass = ""; // Kosongkan jika pakai XAMPP default
$dbname = "10523035_salvanohpp"; // Sesuaikan dengan nama database

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
