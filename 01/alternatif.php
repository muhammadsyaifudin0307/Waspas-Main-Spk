<?php
include "../assets/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $sql = "DELETE FROM tbl_alternatif WHERE id_alternatif='$_GET[id_alternatif]'";
        $stm = $conn->query($sql);
        header("location:alternatif.php");
    }
}
include "header.php";
?>
<main>
    <div class="site-section">
        <div class="container">


            <h2 class="mb-4">Alternatif</h2>
            <hr>
            <a href="alternatif-simpan.php" class="btn btn-primary mb-4"></i>Tambah Data</a>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                        <td class="text-center">
                            <a href="alternatif-ubah.php?id_alternatif=<?= $a['id_alternatif'] ?> " class="btn btn-success"><i class="icon-edit"></i>


                            </a>
                            <a href="alternatif.php?id_alternatif=<?= $a['id_alternatif'] ?>&aksi=hapus" class="btn btn-danger"><i class="icon-trash-o"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>


        </div>
    </div>
</main>