<?php include "header.php";




// Query to get total count of alternatives
$sql_alternatif = "SELECT COUNT(*) AS total_alternatif FROM tbl_alternatif";
$result_alternatif = $conn->query($sql_alternatif);
$row_alternatif = $result_alternatif->fetch_assoc();
$total_alternatif = $row_alternatif['total_alternatif'];

// Query to get total count of criteria
$sql_kriteria = "SELECT COUNT(*) AS total_kriteria FROM tbl_kriteria";
$result_kriteria = $conn->query($sql_kriteria);
$row_kriteria = $result_kriteria->fetch_assoc();
$total_kriteria = $row_kriteria['total_kriteria'];
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css">
    <style>
        .icon {
            font-size: 3.5rem;
        }

        .card-1 {
            background: linear-gradient(to right, #4568DC, #B06AB3);
            color: whitesmoke;
        }

        .card-2 {
            background: linear-gradient(to right, #11998e, #38ef7d);
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <main>
        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-1">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="bx bxs-user icon"></i>
                                    <div class="ml-3 ">
                                        <h5 class="font-weight-bolder card-title mb-0 text-white">Alternatif</h5>
                                        <p class="font-weight-bolder card-text display-4 text-white "><?php echo $total_alternatif; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="bx bxs-graduation icon"></i>
                                    <div class="ml-3">
                                        <h5 class="font-weight-bolder card-title mb-0 text-white">Kriteria</h5>
                                        <p class="font-weight-bolder card-text display-4 text-white "><?php echo $total_kriteria; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <?php
                // Aktifkan pelaporan kesalahan
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                try {
                    $da = "SELECT * FROM tbl_alternatif ORDER BY nilai_waspas DESC";
                    $s = $conn->query($da);
                    $rank = 1;
                    while ($aa = $s->fetch_assoc()) {
                        $id_alternatif = $aa['id_alternatif'];
                        $sim = "UPDATE tbl_alternatif SET rangking = ? WHERE id_alternatif = ?";
                        $stmt = $conn->prepare($sim);
                        $stmt->bind_param("ii", $rank, $id_alternatif);
                        $stmt->execute();
                        $rank++;
                    }

                    // Ambil alternatif dengan peringkat tertinggi
                    $topRankQuery = "SELECT * FROM tbl_alternatif ORDER BY rangking LIMIT 1";
                    $topRankResult = $conn->query($topRankQuery);

                    if ($topRankResult->num_rows > 0) {
                        $topRank = $topRankResult->fetch_assoc();
                ?>

                        <p class="text-center text-dark font-weight-bold">
                            Dalam metode Waspas (Weighted Aggregated Sum Product Assessment), alternatif dengan peringkat tertinggi adalah
                            <strong class="text-primary"><?= htmlspecialchars($topRank['nama_alternatif']) ?></strong>
                            memiliki nilai akhir sebesar <strong class="text-primary"><?= number_format($topRank['nilai_waspas'], 4) ?></strong>.
                            yang merupakan nilai tertinggi di antara seluruh alternatif yang dianalisis.

                            Hal ini terjadi karena, <strong class="text-primary"><?= htmlspecialchars($topRank['nama_alternatif']) ?></strong> memiliki kinerja yang paling optimal berdasarkan perhitungan rasio dari berbagai kriteria yang telah ditetapkan sebelumnya.

                        </p>

                    <?php
                    } else {
                    ?>

                        <p class="text-center text-dark font-weight-bold">
                            Tidak ada alternatif yang tersedia dalam metode Waspas saat ini.
                        </p>

                <?php
                    }
                } catch (mysqli_sql_exception $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </main>
</body>
</body>

</html>