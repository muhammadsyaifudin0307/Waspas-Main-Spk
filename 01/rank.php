    <?php
    include "header.php";
    ?>
    <main>
        <div class="site-section">
            <div class="container">


                <h2 class="mb-4 font-weight-bold">Rank</h2>


                <table class="table table-striped ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Rank</th>
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
                            <td class="text-center"><?= $a['rangking'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>