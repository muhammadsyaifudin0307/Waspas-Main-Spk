<?php include "header.php"; ?>

<main>
    <div class="site-section">
        <div class="container">

            <h2 class="mb-4">Metode</h2>
            <hr>
            <br>
            <h5>Data Kriteria</h5>

            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama kriteria</th>
                        <th class="text-center">Bobot</th>

                    </tr>
                </thead>
                <?php
                //normalisasi bobot
                $n_wj = array();
                $sql = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                $stm = $conn->query($sql);
                $no = 1;
                $sum_bobot = 0;
                while ($a = $stm->fetch_assoc()) {
                    $dsum = "SELECT bobot_kriteria as nBobot FROM tbl_kriteria";
                    $s = $conn->query($dsum);
                    $ns = $s->fetch_assoc();
                    //normalisasi bobot
                    $nwj = $a['bobot_kriteria'];
                    $n_wj[] = array(
                        'nilai_wj' => $nwj
                    );

                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['nama_kriteria'] ?> - (<?= $a['tipe_kriteria'] ?>)</td>
                        <td class="text-center"><?= $a['bobot_kriteria'] ?></td>

                        </td>



                    </tr>
                <?php } ?>
            </table>
            <br>
            <h5>Matrik Keputusan</h5>
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

                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM  tbl_nilai WHERE id_alternatif='$id_alternatif'";
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

                        </tr>
                <?php } else {
                    }
                }
                ?>
            </table>
            <br>

            <h5>Konversi Matrik Keputusan</h5>
            <table class="table table-striped">
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
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                $data_found = false; // Flag to check if data is found

                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) {
                        $data_found = true; // Data is found
                ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                            <?php

                            $nilaimax = array();
                            $nilaimin = array();
                            $data = "SELECT s.nilai_subkriteria as n_sub, n.id_kriteria as id_kriteria, k.tipe_kriteria as tipe_kriteria FROM tbl_nilai n, tbl_subkriteria s, tbl_kriteria k 
                WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria = k.id_kriteria AND n.id_alternatif='$id_alternatif' ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                $nilai_sub = $dtn['n_sub'];
                                // nilai max
                                $nmax = "SELECT MAX(s.nilai_subkriteria) as n_max FROM tbl_nilai n, tbl_subkriteria s WHERE 
                    n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $nn = $conn->query($nmax);
                                $n_m = $nn->fetch_assoc();
                                $nilai_max = $n_m['n_max'];
                                $nilaimax[] = array(
                                    'n_max' => $nilai_max
                                );
                                // nilai min
                                $nmin = "SELECT Min(s.nilai_subkriteria) as n_min FROM tbl_nilai n, tbl_subkriteria s WHERE 
                       n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $ni = $conn->query($nmin);
                                $n_i = $ni->fetch_assoc();
                                $nilai_min = $n_i['n_min'];
                                $nilaimin[] = array(
                                    'n_min' => $nilai_min
                                );

                                echo "<td class='text-center'>$nilai_sub</td>";
                            } ?>
                        </tr>
                    <?php
                    }
                }

                if ($data_found) {
                    ?>
                    <tr>
                        <td colspan="2"><b>Maxsimal</b></td>
                        <?php
                        foreach ($nilaimax as $n_max) {
                            echo "<td class='text-center'><b>$n_max[n_max]</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Minimal</b></td>
                        <?php
                        foreach ($nilaimin as $n_min) {
                            echo "<td class='text-center'><b>$n_min[n_min]</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Wj</b></td>
                        <?php
                        foreach ($n_wj as $nwj) {
                            echo "<td class='text-center'><b>$nwj[nilai_wj]</b></td>";
                        }
                        ?>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td colspan="100%" class="text-center">Masukkan data terlebih dahulu</td>
                    </tr>
                <?php
                }
                ?>
            </table> <br>


            <h5>Normalisasi Matrik</h5>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria] - ($row[tipe_kriteria]) </th>";
                        } ?>

                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM  tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) { ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>;
                            <?php
                            $data = "SELECT s.nilai_subkriteria as n_sub, n.id_kriteria as id_kriteria, k.tipe_kriteria as tipe_kriteria FROM tbl_nilai n, tbl_subkriteria s, tbl_kriteria k 
                WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria = k.id_kriteria AND n.id_alternatif='$id_alternatif' ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                $nilai_sub = $dtn['n_sub'];
                                // nilai max
                                $nmax = "SELECT MAX(s.nilai_subkriteria) as n_max FROM tbl_nilai n, tbl_subkriteria s WHERE 
                    n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $nn = $conn->query($nmax);
                                $n_m = $nn->fetch_assoc();
                                $nilai_max = $n_m['n_max'];

                                // nilai min
                                $nmin = "SELECT Min(s.nilai_subkriteria) as n_min FROM tbl_nilai n, tbl_subkriteria s WHERE 
                       n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $ni = $conn->query($nmin);
                                $n_i = $ni->fetch_assoc();
                                $nilai_min = $n_i['n_min'];

                                // cek kriteria
                                if ($dtn['tipe_kriteria'] == 'Benefit') {
                                    $n_nm = $nilai_sub / $nilai_max;
                                } else if ($dtn['tipe_kriteria'] == 'Cost') {
                                    $n_nm = $nilai_min / $nilai_sub;
                                }
                                echo "<td class= 'text-center'> " . number_format($n_nm, 2) . "</td>";
                            } ?>

                        </tr>
                <?php } else {
                    }
                }
                ?>


            </table>
            <br>


            <h5>Perhitungan Nilai Qa</h5>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria] - ($row[tipe_kriteria]) </th>";
                        } ?>
                        <th class="text-center">Qa</th>

                    </tr>
                </thead>
                <?php

                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];
                    $sum_nqa = 0;
                    $cek = "SELECT * FROM  tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) { ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>;
                            <?php
                            $data = "SELECT s.nilai_subkriteria as n_sub, n.id_kriteria as id_kriteria, k.tipe_kriteria as tipe_kriteria FROM tbl_nilai n, tbl_subkriteria s, tbl_kriteria k 
                WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria = k.id_kriteria AND n.id_alternatif='$id_alternatif' ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                $nilai_sub = $dtn['n_sub'];
                                // nilai max
                                $nmax = "SELECT MAX(s.nilai_subkriteria) as n_max FROM tbl_nilai n, tbl_subkriteria s WHERE 
                    n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $nn = $conn->query($nmax);
                                $n_m = $nn->fetch_assoc();
                                $nilai_max = $n_m['n_max'];

                                // nilai min
                                $nmin = "SELECT Min(s.nilai_subkriteria) as n_min FROM tbl_nilai n, tbl_subkriteria s WHERE 
                       n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $ni = $conn->query($nmin);
                                $n_i = $ni->fetch_assoc();
                                $nilai_min = $n_i['n_min'];

                                // cek kriteria
                                if ($dtn['tipe_kriteria'] == 'Benefit') {
                                    $n_nm = $nilai_sub / $nilai_max;
                                } else if ($dtn['tipe_kriteria'] == 'Cost') {
                                    $n_nm = $nilai_min / $nilai_sub;
                                }

                                //panggil nilai bobot
                                $sqk = "SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria = '$dtn[id_kriteria]'";
                                $stk = $conn->query($sqk);
                                $ak = $stk->fetch_assoc();

                                $dsum = "SELECT bobot_kriteria as nBobot FROM tbl_kriteria";
                                $s = $conn->query($dsum);
                                $ns = $s->fetch_assoc();
                                $norma_bobot = $ak['bobot_kriteria'];

                                //hitung Qa
                                $nqa = $n_nm * $norma_bobot;
                                $sum_nqa += $nqa;
                                echo "<td class= 'text-center'> " . number_format($nqa, 3) . "</td>";
                            }

                            echo "<td class= 'text-center'> " . number_format($sum_nqa, 2) . "</td>";
                            ?>

                        </tr>
                <?php } else {
                    }
                    //ambil nilai Qa
                    $simpan = "UPDATE tbl_alternatif SET matriks_a ='$sum_nqa' WHERE id_alternatif = '$id_alternatif'";
                    $ss = $conn->query($simpan);
                }
                ?>


            </table>
            <br>



            <h5>Perhitungan Nilai Qb</h5>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        if (!$a) {
                            die("Query Error: " . $conn->error);
                        }
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria] - ($row[tipe_kriteria]) </th>";
                        } ?>
                        <th class="text-center">Qb</th>
                    </tr>
                </thead>
                <?php

                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                if (!$stm) {
                    die("Query Error: " . $conn->error);
                }
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];
                    $sum_nqb = 1; // Set initial value of Qb to 1
                    $cek = "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if (!$k) {
                        die("Query Error: " . $conn->error);
                    }
                    if ($k->num_rows > 0) { ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                            <?php
                            $data = "SELECT s.nilai_subkriteria as n_sub, n.id_kriteria as id_kriteria, k.tipe_kriteria as tipe_kriteria 
                         FROM tbl_nilai n, tbl_subkriteria s, tbl_kriteria k 
                         WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria = k.id_kriteria AND n.id_alternatif='$id_alternatif' 
                         ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            if (!$b) {
                                die("Query Error: " . $conn->error);
                            }
                            while ($dtn = $b->fetch_assoc()) {
                                $nilai_sub = $dtn['n_sub'];

                                // nilai max
                                $nmax = "SELECT MAX(s.nilai_subkriteria) as n_max FROM tbl_nilai n, tbl_subkriteria s 
                             WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $nn = $conn->query($nmax);
                                if (!$nn) {
                                    die("Query Error: " . $conn->error);
                                }
                                $n_m = $nn->fetch_assoc();
                                $nilai_max = $n_m['n_max'];

                                // nilai min
                                $nmin = "SELECT Min(s.nilai_subkriteria) as n_min FROM tbl_nilai n, tbl_subkriteria s 
                             WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $ni = $conn->query($nmin);
                                if (!$ni) {
                                    die("Query Error: " . $conn->error);
                                }
                                $n_i = $ni->fetch_assoc();
                                $nilai_min = $n_i['n_min'];

                                // cek kriteria
                                if ($dtn['tipe_kriteria'] == 'Benefit') {
                                    $n_nm = $nilai_sub / $nilai_max;
                                } else if ($dtn['tipe_kriteria'] == 'Cost') {
                                    $n_nm = $nilai_min / $nilai_sub;
                                }

                                // panggil nilai bobot
                                $sqk = "SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria = '$dtn[id_kriteria]'";
                                $stk = $conn->query($sqk);
                                if (!$stk) {
                                    die("Query Error: " . $conn->error);
                                }
                                $ak = $stk->fetch_assoc();
                                $bobot_kriteria = $ak['bobot_kriteria'];

                                // hitung Qa
                                $nqb = pow($n_nm, $bobot_kriteria);
                                $sum_nqb *= $nqb;

                                echo "<td class='text-center'>" . number_format($nqb, 3) . "</td>";
                            }

                            echo "<td class='text-center'>" . number_format($sum_nqb, 2) . "</td>";
                            ?>

                        </tr>
                <?php
                    }
                    // ambil nilai Qa
                    $simpan = "UPDATE tbl_alternatif SET matriks_b ='$sum_nqb' WHERE id_alternatif = '$id_alternatif'";
                    $ss = $conn->query($simpan);
                    if (!$ss) {
                        die("Query Error: " . $conn->error);
                    }
                }
                ?>
                </thead>
            </table>


            <?php
            // Hitung nilai Qi dan update ke database
            $data = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
            $ss = $conn->query($data);

            if ($ss === FALSE) {
                die("Error: " . $conn->error);
            }

            if ($ss->num_rows > 0) {
                while ($a = $ss->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $qa = $a['matriks_a']; // Pastikan matriks_a dihitung sebelumnya
                    $qb = $a['matriks_b'];

                    // Hitung nilai Qi
                    $qi = (0.5 * $qa) + (0.5 * $qb);

                    // Update nilai Qi ke dalam tabel
                    $updateQi = "UPDATE tbl_alternatif SET nilai_waspas = '$qi' WHERE id_alternatif = '$id_alternatif'";
                    $conn->query($updateQi);
                }
            } else {
                echo "No records found in tbl_alternatif.<br>";
            }

            // Rank berdasarkan nilai_waspas
            $da = "SELECT * FROM tbl_alternatif ORDER BY nilai_waspas DESC";
            $s = $conn->query($da);

            if ($s === FALSE) {
                die("Error: " . $conn->error);
            }

            $rank = 1;

            if ($s->num_rows > 0) {
                while ($aa = $s->fetch_assoc()) {
                    $id_alternatif = $aa['id_alternatif'];
                    $nilai_waspas = $aa['nilai_waspas'];

                    // Update ranking ke dalam tabel
                    $sim = $conn->prepare("UPDATE tbl_alternatif SET rangking = ? WHERE id_alternatif = ?");
                    $sim->bind_param("ii", $rank, $id_alternatif);
                    $sim->execute();

                    if ($sim === FALSE) {
                        die("Error: " . $conn->error);
                    }

                    $rank++;
                }
            } else {
                echo "No records found for ranking.<br>";
            }
            ?>

            <h5>Hasil</h5>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <th class="text-center">Nilai</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY rangking";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                        <td class="text-center"><?= number_format($a['nilai_waspas'], 3) ?></td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</main>