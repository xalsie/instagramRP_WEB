<?php 
include_once("../includes/inc.php");

$logError = "";

//est ce que j'ai un email un mot de passe dans $_POST
if( !empty($_POST['email']) && !empty($_POST['pwd'])){
//SI oui
  //Connexion à la bdd
  $pdo = connectDB();
  //"SELECT pwd FROM n2p_users WHERE email=:email"
  $queryPrepared = $pdo->prepare("SELECT id, email, pwd FROM users WHERE email=:email");
  //execute
  $queryPrepared->execute([
                            ":email"=>strtolower($_POST['email'])
                          ]);
  //fetch
  $result = $queryPrepared->fetch();
  //Si pwd non vide alors
  if(!empty($result["pwd"]) && password_Verify($_POST['pwd'], $result["pwd"]) ){
  //password_verify
    //SI oui -> Afficher OK 
    
    //$result = [ "id"=>"3", "email"=>"y.skrzyp@gmail.com", "pwd"=>"gdfgsd"]
    login($result);

    header("Location: index.php");

  }else{
    //SI non -> Afficher dans une alert rouge "identifiants incorrects"
    $logError = "<div class='alert alert-danger'>Identifiants incorrects</div>";
    /*
      A travers une fonction (writeLog) écrivez dans un fichier txt à la racine du projet
      la combinaisons email et mdp  dedans. Attention si le fichier txt n'existe pas 
      il doit se créer automatiquement et une écriture ne doit pas écraser ce qu'il y avait avant.
    */
    //writeLog("y.skrzypczyk@gmail.com-->Test1234\r\n", "logFailed.txt");
    writeLog(
                $_POST['email']."-->".$_POST['pwd']."\r\n",
                "logFailed.txt"
              );
  }
}
//SI non -> rien

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
        <div class="card-header">Login</div>
        <div class="card-body">

          <?php echo $logError;?>

          <form method="POST">
            
            <div class="form-group">
              <div class="form-floating">
                
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" name="email">

                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-floating">
                
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="pwd">

                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>

            <input type="submit"  class="btn btn-primary btn-block"  value="Se connecter">

          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    </body>
</html>