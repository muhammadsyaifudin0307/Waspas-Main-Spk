<?php
if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'login') {
    session_start();
    include "assets/conn/config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM tbl_akun WHERE username='$username' AND password ='$password'";
    $stm = $conn->query($query);
    $row = $stm->num_rows;

    if ($row > 0) {
      $data = $stm->fetch_assoc();
      $id_akun = $data['id_akun'];
      $_SESSION['id_akun'] = $id_akun;
      header("location:01/index.php");
    } else {
      header("location:index.php?pesan=gagal");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="login/css/style.css" />
</head>

<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center"></div>
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url(login/images/spk-icon.png)"></div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4">Sign In</h3>
                </div>
              </div>
              <form class="signin-form validate-form" action="index.php?aksi=login" method="post">
                <div class="form-group mb-3">

                  <?php
                  if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == 'gagal') {
                      echo "<div class='alert alert-danger'><span class='fa fa-times'></span>& 
							emsp; Login Gagal !!!</div>";
                    }
                  } ?>
                  <label class="label" for="name">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Username" required />
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="password" name=>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password" required />
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                    Sign In
                  </button>
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50 text-left">
                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                      <input type="checkbox" checked />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="login/js/jquery.min.js"></script>
  <script src="login/js/popper.js"></script>
  <script src="login/js/bootstrap.min.js"></script>
  <script src="login/js/main.js"></script>
</body>

</html>