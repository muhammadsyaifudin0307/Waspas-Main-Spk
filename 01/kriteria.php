<?php
include "../assets/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // Menghapus subkriteria dan nilai terkait terlebih dahulu
        $id_kriteria = $_GET['id_kriteria'];

        // Asumsi bahwa Anda memiliki tabel seperti tbl_subkriteria dan tbl_nilai
        $sql_sub = "DELETE FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria'";
        $conn->query($sql_sub);

        $sql_nilai = "DELETE FROM tbl_nilai WHERE id_kriteria='$id_kriteria'";
        $conn->query($sql_nilai);

        // Kemudian menghapus kriteria utama
        $sql = "DELETE FROM tbl_kriteria WHERE id_kriteria='$id_kriteria'";
        $conn->query($sql);

        header("location:kriteria.php");
    }
}
include "header.php";
?>
<main>
    <div class="site-section">
        <div class="container">

            <h2 class="mb-4">Kriteria</h2>
            <hr>
            <a href="kriteria-simpan.php" class="btn btn-primary mb-4"></i>Tambah Data</a>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Kriteria</th>
                        <th class="text-center">Bobot</th>
                        <th class="text-center">Tipe</th>
                        <th class="text-center">Subkriteria</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['nama_kriteria'] ?></td>
                        <td class="text-center"><?= $a['bobot_kriteria'] ?></td>
                        <td class="text-center"><?= $a['tipe_kriteria'] ?></td>
                        <td class="text-center">
                            <a href="subkriteria.php?id_kriteria=<?= $a['id_kriteria'] ?>" class="btn btn-secondary"><i class='icon-plus'></i></a>
                        </td>
                        <td class="text-center">
                            <a href="kriteria-ubah.php?id_kriteria=<?= $a['id_kriteria'] ?>" class="btn btn-success "><i class='icon-edit'></i></a>
                            <a href="kriteria.php?id_kriteria=<?= $a['id_kriteria'] ?>&aksi=hapus" class="btn btn-danger"><i class='icon-trash-o'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</main>