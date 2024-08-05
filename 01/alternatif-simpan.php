<?php
include "../assets/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $nama_alternatif = $_POST['nama_alternatif'];
        $sql = "INSERT INTO tbl_alternatif (nama_alternatif) VALUES('$nama_alternatif')";
        $row = $conn->query($sql);
        header("location:alternatif.php");
    }
}
include "header.php"; ?>

<main>
    <div class="site-section">
        <div class="container">

            <h2 class="mb-4">Tambah Data</h2>
            <hr>
            <form action="alternatif-simpan.php?aksi=simpan" method="post">
                <div class="form-group">
                    <label>Nama Alternatif</label>
                    <input type="text" name="nama_alternatif" class="form-control">
                </div>
                <hr>
                <input type="submit" value="Simpan" class="btn btn-primary">
                <a href="alternatif.php" class="btn badge-secondary">Batal</a>
            </form>

        </div>
    </div>
</main>