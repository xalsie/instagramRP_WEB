<?php
  include_once("../includes/inc.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="LeGrizzly#0341, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Register panel</title>

    <!--
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      Instagram RP - 0.0.5
      Updated: January 11, 2021
      Theme by: LeGrizzly - LeGrizzly#0341
      Support: LeGrizzly#0341
        _____ __        __        __  __      __       __
        / ___// /___  __/ /__     / / / /___ _/ /______/ /_
        \__ \/ __/ / / / / _ \   / /_/ / __ `/ __/ ___/ __ \
      ___/ / /_/ /_/ / /  __/  / __  / /_/ / /_/ /__/ / / /
      /____/\__/\__, /_/\___/  /_/ /_/\__,_/\__/\___/_/ /_/
              /____/
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    -->

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/css/bootstrap-utilities.min.css" rel="stylesheet">

    <!-- Favicons -->
    <!-- <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico"> -->
    <meta name="theme-color" content="#7952b3">

    <!-- Script init -->
    <script src="../assets/jQuery/js/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <link href="../assets/SweetAlert2/css/sweetalert2.min.css" rel="stylesheet">
    <script src="../assets/SweetAlert2/js/sweetalert2.min.js"></script>

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/css/home.css?v=0.1" rel="stylesheet">

    <style>
    .form-group {
      margin-bottom: 16px;
    }
    .mt-5 {
      margin-top: 6rem!important;
      width: 70%;
    }
    </style>

  </head>
  <body class="bg-light">
    <div class="container">
      <!-- <div class="card card-register mx-auto mt-5"> -->
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">

          <?php
            if(isset($_SESSION["errors"])){
              echo "<div class='alert alert-danger'>";
              foreach ($_SESSION["errors"] as $error) {
                echo "<li>".$error;
              }
              echo "</div>";
            }
          ?>


          <form action="addUser.php" method="POST">

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-floating">
                    
                    <input 
                      type="text" 
                      id="firstName" 
                      name="firstName" 
                      class="form-control" 
                      placeholder="First name" 
                      required="required" 
                      autofocus="autofocus"
                      value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["firstName"]:"";?>"
                      >


                    <label for="firstName">Pseudo RP</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name" required="required"
                      value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["lastName"]:"";?>">
                    <label for="lastName">Indentifiant Discord</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-floating">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="required"
                      value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["inputEmail"]:"";?>">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>
            
            <input type="submit"  class="btn btn-primary btn-block" value="Register">

          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Login Page</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>