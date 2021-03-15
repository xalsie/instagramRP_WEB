<?php
if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
  $path = "C:/wamp64/www/intagramRP_WEB";
} else {
  $path = $_SERVER["DOCUMENT_ROOT"];
}
include_once($path."/includes/inc.php");

$logError = "";

//est ce que j'ai un email un mot de passe dans $_POST
if(!empty($_POST['email']) && !empty($_POST['pwd'])) {
//SI oui
  //Connexion à la bdd
  // $pdo = connectDB();
  // //"SELECT pwd FROM n2p_users WHERE email=:email"
  // $queryPrepared = $pdo->prepare("SELECT id, email, pwd FROM users WHERE email=:email");
  // //execute
  // $queryPrepared->execute([
  //                           ":email"=>strtolower($_POST['email'])
  //                         ]);
  // //fetch
  // $result = $queryPrepared->fetch();

  $SQL = "SELECT `id`, `email`, `password` FROM `users` WHERE email = '".strtolower($_POST['email'])."';";
    $result = db_query($SQL)[0];

  //Si pwd non vide alors
  if(!empty($result["password"]) && password_Verify($_POST['pwd'], $result["password"]) ){
  //password_verify
    //SI oui -> Afficher OK 
    
    //$result = [ "id"=>"1", "email"=>"gg@gmail.com", "pwd"=>"gdfgsd"]
    login($result);

    header("Location: ../index.php");

  }else{
    //SI non -> Afficher dans une alert rouge "identifiants incorrects"
    $logError = "<div class='alert alert-danger'>Identifiants incorrects</div>";
    /*
      A travers une fonction (writeLog) écrivez dans un fichier txt à la racine du projet
      la combinaisons email et mdp  dedans. Attention si le fichier txt n'existe pas 
      il doit se créer automatiquement et une écriture ne doit pas écraser ce qu'il y avait avant.
    */
    //writeLog("y.skrzypczyk@gmail.com-->Test1234\r\n", "logFailed.txt");
    // writeLog(
    //             $_POST['email']."-->".$_POST['pwd']."\r\n",
    //             "logFailed.txt"
    //           );
  }
}
//SI non -> rien

$includeHeader = "";

echo Header_HTML("intagramRP - United RP", $includeHeader);
?>

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

          <form method="POST" action="">
            
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

<?php
  echo Footer_HTML();
?>