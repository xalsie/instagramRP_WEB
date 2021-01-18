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
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Reset Password</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4>Forgot your password?</h4>
            <p>Enter your email address and we will send you instructions on how to reset your password.</p>
          </div>
          <form>
            <div class="form-group">
              <div class="form-floating">
                <input type="email" id="inputEmail" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus">
                <label for="inputEmail">Enter email address</label>
              </div>
            </div>
            <a class="btn btn-primary btn-block" href="login.html">Reset Password</a>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="login.php">Login Page</a>
          </div>
        </div>
      </div>
    </div>

    </body>
</html>