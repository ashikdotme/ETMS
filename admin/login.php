<?php 
session_start();
require_once('../config.php');
if(isset($_POST['admin_login'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Data base 
  $stm=$pdo->prepare("SELECT ad_id,username,password FROM em_admins WHERE username=?");
  $stm->execute(array($username));
  $adCount=$stm->rowCount();
 
  if(empty($username)){
    $error = "Username is Required!";
  }
  else if(empty($password)){
    $error = "Password is Required!";
  }else if($adCount != 1){
    $error = "Username or Password is Wrong!";
  }else{

    $adRows = $stm->fetchAll(PDO::FETCH_ASSOC);
    $db_password = $adRows[0]['password'];

    $password = SHA1($password);
    if($password == $db_password){

      $_SESSION['em_admin'] = $adRows;
      header('location:index.php');

    }else{
        $error = "Username or Password is Wrong!";
    }
  }

}

// if already logged in
if(isset($_SESSION['em_admin'])){
  header('location:index.php');
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>ETMS - Admin Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Admin Login</h4>
              </div>
              <?php if(isset($error)) : ?>
                <div class="alert alert-danger">
                  <?php echo $error; ?>
                </div>
              <?php endif; ?>
              <div class="card-body">
                <form method="POST" action="" class="was-validated" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required>
                    <div class="invalid-feedback">
                      Please fill in your Username
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forget-password.php" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>

                    <div class="invalid-feedback">
                      please fill in your password
                    </div>

                  </div>
                 <!--  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <button type="submit" name="admin_login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                
              </div>
            </div>
             
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
 

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>