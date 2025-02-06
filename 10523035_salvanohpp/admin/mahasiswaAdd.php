<?php
include('../koneksi/koneksi.php');
?>

<div class="content-wrapper">
    <h2>📝 Tambah Data Mahasiswa</h2>
    <hr/><br/>

    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
    ?>
        <div class="form-container">
            <form enctype="multipart/form-data" method="post">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM" required />

                <label>Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required />

                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <label><input type="radio" name="jk" value="Laki-Laki" required /> Laki-Laki</label>
                    <label><input type="radio" name="jk" value="Perempuan" /> Perempuan</label>
                </div>

                <label>Jurusan</label>
                <select name="jurusan" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Komputer">Teknik Komputer</option>
                </select>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" required />

                <button type="submit" name="submit">🚀 Tambah Data</button>
            </form>
        </div>
    <?php
    } else {
        $nim = htmlspecialchars($_POST["nim"]);
        $nama = htmlspecialchars($_POST["nama"]);
        $jk = htmlspecialchars($_POST["jk"]);
        $jurusan = htmlspecialchars($_POST["jurusan"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Cek apakah NIM sudah ada
        $cekQuery = $koneksi->prepare("SELECT nim FROM mahasiswa WHERE nim = ?");
        $cekQuery->bind_param("s", $nim);
        $cekQuery->execute();
        $cekQuery->store_result();

        if ($cekQuery->num_rows > 0) {
            echo "<script>alert('⚠️ NIM sudah terdaftar! Gunakan NIM lain.'); window.location.href='./?adm=mahasiswa';</script>";
        } else {
            // Lanjutkan insert jika NIM belum ada
            $stmt = $koneksi->prepare("INSERT INTO mahasiswa (nim, nama, jk, jurusan, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nim, $nama, $jk, $jurusan, $password);
            
            if ($stmt->execute()) {
                echo "<script>alert('🎉 Data Berhasil Disimpan!'); window.location.href='./?adm=mahasiswa';</script>";
            } else {
                echo "<script>alert('⚠️ Data Gagal Disimpan!');</script>";
            }

            $stmt->close();
        }
        
        $cekQuery->close();
    }
    ?>

    <br>
    <a href="./?adm=mahasiswa" class="back-link">🔙 Kembali</a>
</div>

<style>
    .content-wrapper {
        max-width: 500px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        font-family: Arial, sans-serif;
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    h2 {
        text-align: center;
        color: #1976D2;
        font-weight: bold;
    }
    label {
        display: block;
        font-weight: bold;
        margin: 10px 0 5px;
    }
    input, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    .radio-group {
        display: flex;
        gap: 20px;
    }
    button {
        width: 100%;
        background: #1976D2;
        color: white;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #0D47A1;
    }
    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #1976D2;
        font-weight: bold;
        text-decoration: none;
    }
    .back-link:hover {
        text-decoration: underline;
    }
</style>
