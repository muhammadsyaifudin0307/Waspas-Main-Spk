<?php
include "../assets/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // First, delete the associated tbl_nilai records
        $sqlDeleteNilai = "DELETE FROM tbl_nilai WHERE id_alternatif='$_GET[id_alternatif]'";
        $conn->query($sqlDeleteNilai);

        // Then, delete the alternatif itself
        $sqlDeleteAlternatif = "DELETE FROM tbl_alternatif WHERE id_alternatif='$_GET[id_alternatif]'";
        $conn->query($sqlDeleteAlternatif);

        header("location:nilai.php");
    }
}
include "header.php";
?>

<main>
    <div class="site-section">
        <div class="container">


            <h2 class="mb-4">Nilai</h2>
            <hr>
            <a href="nilai-simpan.php" class="btn btn-primary mb-4">Tambah Data</a>

            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria]</th>";
                        } ?>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) { ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>;
                            <?php
                            $data = "SELECT s.nama_subkriteria as nm_sub FROM tbl_nilai n, tbl_subkriteria s 
        WHERE n.id_subkriteria=s.id_subkriteria AND n.id_alternatif='$id_alternatif' ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                echo "<td class= 'text-center'>$dtn[nm_sub]</td>";
                            } ?>
                            <td class="text-center">
                                <a href="nilai-ubah.php?id_alternatif=<?= $a['id_alternatif'] ?>" class="btn btn-success">
                                    <i class="icon-edit"></i></a>
                                <a href="nilai.php?id_alternatif=<?= $a['id_alternatif'] ?>&aksi=hapus" class="btn btn-danger"><i class="icon-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                <?php } else {
                    }
                }
                ?>
            </table>

        </div>
    </div>
</main>