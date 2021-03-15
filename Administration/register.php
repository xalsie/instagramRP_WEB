<?php
if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
  $path = "C:/wamp64/www/intagramRP_WEB";
} else {
  $path = $_SERVER["DOCUMENT_ROOT"];
}
include_once($path."/includes/inc.php");

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
                      id="namePR" 
                      name="namePR" 
                      class="form-control" 
                      placeholder="Your name RP" 
                      required="required" 
                      autofocus="autofocus"
                      value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["namePR"]:"";?>"
                      >


                    <label for="namePR">Pseudo RP</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" id="nameDiscord" name="nameDiscord" class="form-control" placeholder="Your identifiant Discord" required="required"
                      value="<?php echo (isset($_SESSION["errorsInput"]))?$_SESSION["errorsInput"]["nameDiscord"]:"";?>">
                    <label for="nameDiscord">Indentifiant Discord</label>
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
            
            <input type="submit" class="btn btn-primary btn-block" value="Register">

          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Login Page</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

<?php
  echo Footer_HTML();
?>