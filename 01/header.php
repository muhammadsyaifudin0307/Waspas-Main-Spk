<?php
session_start();
include "../assets/conn/config.php";
include "../assets/conn/cek.php";

$query = "SELECT * FROM tbl_akun WHERE id_akun='$_SESSION[id_akun]'";
$stm = $conn->query($query);
$row = $stm->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="fonts/icomoon/style.css" />

  <link rel="stylesheet" href="css/owl.carousel.min.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css" />

  <title>Waspas</title>
</head>

<body>
  <aside class="sidebar">
    <div class="toggle">
      <a href="" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
        <span></span>
      </a>
    </div>
    <div class="side-inner">
      <div class="profile">
        <img src="images/images.png" alt="Image" class="img-fluid" />
        <h3 class="name">Hello</h3>
        <span class="country"><?= $row['nama_lengkap'] ?></span>
      </div>

      <div class="nav-menu">
        <ul>
          <li>
            <a href="index.php"><span class="icon-home mr-3"></span>Dashboard</a>
          </li>
          <li>
            <a href="alternatif.php"><span class="icon-institution mr-3"></span>Data Alternatif</a>
          </li>
          <li>
            <a href="kriteria.php"><span class=" icon-archive mr-3"></span>Data Kriteria</a>
          </li>
          <li>
            <a href="nilai.php"><span class="icon-bitcoin mr-3"></span>Nilai</a>
          </li>
          <li>
            <a href="metode.php"><span class="icon-table mr-3"></span>Perhitungan</a>
          </li>
          <li>
            <a href="rank.php"><span class="icon-trophy mr-3"></span>Ranking</a>
          </li>
          <li>
            <a href="logout.php"><span class="icon-sign-out mr-3"></span>Sign out</a>
          </li>
        </ul>
      </div>
    </div>
  </aside>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>