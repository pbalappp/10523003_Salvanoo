<?php
include ('../koneksi/koneksi.php');

$getNim = $_GET['nim'];
$editMhs = "SELECT * FROM mahasiswa WHERE nim = ?";
$stmt = $koneksi->prepare($editMhs);
$stmt->bind_param("s", $getNim);
$stmt->execute();
$resultMhs = $stmt->get_result();
$dataMhs = $resultMhs->fetch_assoc();
?>

<div class="content-wrapper">
    <h2>✏️ Edit Data Mahasiswa</h2>
    <hr/><br/>

    <?php
    if (!isset($_POST['submit'])) {
    ?>
        <div class="form-container">
            <form enctype="multipart/form-data" method="post">
                <label>NIM</label>
                <input type="text" name="nim" value="<?php echo htmlspecialchars($dataMhs['nim']); ?>" readonly />

                <label>Nama</label>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($dataMhs['nama']); ?>" required />

                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <label><input type="radio" name="jk" value="Laki-Laki" <?php echo ($dataMhs['jk'] == 'Laki-Laki') ? 'checked' : ''; ?>> Laki-Laki</label>
                    <label><input type="radio" name="jk" value="Perempuan" <?php echo ($dataMhs['jk'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan</label>
                </div>

                <label>Jurusan</label>
                <select name="jurusan" required>
                    <option value="<?php echo htmlspecialchars($dataMhs['jur']); ?>" selected><?php echo htmlspecialchars($dataMhs['jur']); ?></option>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Komputer">Teknik Komputer</option>
                </select>

                <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" placeholder="Masukkan password baru" />

                <button type="submit" name="submit">💾 Simpan Perubahan</button>
            </form>
        </div>
    <?php
    } else {
        $nim = $_POST['nim'];
        $nama = htmlspecialchars($_POST['nama']);
        $jk = htmlspecialchars($_POST['jk']);
        $jurusan = htmlspecialchars($_POST['jurusan']);
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $dataMhs['password']; 

        $updateMhs = "UPDATE mahasiswa SET nama=?, jk=?, jur=?, password=? WHERE nim=?";
        $stmt = $koneksi->prepare($updateMhs);
        $stmt->bind_param("sssss", $nama, $jk, $jurusan, $password, $nim);
        
        if ($stmt->execute()) {
            echo "<script>alert('🎉 Data Berhasil Diubah!');</script>";
            echo "<script>window.location='./?adm=mahasiswa';</script>";
        } else {
            echo "<script>alert('⚠️ Data Gagal Diubah!');</script>";
            echo "<script>window.location='./?adm=mahasiswa';</script>";
        }
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
    }
    h2 {
        text-align: center;
        color: #1976D2;
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
