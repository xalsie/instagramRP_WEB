<?php
	//àéè
	defined('vSecureInstaRP') or header('Location: /');

	include_once("../includes/inc.php");

if( count($_POST) == 5
 && !empty($_POST["firstName"]) 
 && !empty($_POST["lastName"]) 
 && !empty($_POST["inputEmail"]) 
 && !empty($_POST["inputPassword"]) 
 && !empty($_POST["confirmPassword"]) ){


	//Nettoyer les champs
	$firstName = ucwords(strtolower(trim($_POST["firstName"])));
	$lastName = strtoupper(trim($_POST["lastName"]));
	$email = strtolower(trim($_POST["inputEmail"]));
	$pwd = $_POST["inputPassword"];
	$pwdConfirm = $_POST["confirmPassword"];

	//Vérification des champs

	$error = false;
	$listOfErrors = [];

	//firstName : entre 2 et 50
	if(strlen($firstName)<2 || strlen($firstName)>50){
		$error = true;
		$listOfErrors[] = "Le prenom doit faire entre 2 et 50 caractères";
	}


	//lastName : entre 2 et 100
	if(strlen($lastName)<2 || strlen($lastName)>100){
		$error = true;
		$listOfErrors[] = "Le nom doit faire entre 2 et 100 caractères";
	}

	//pwd : entre 8 et 25
	// -> majuscules, minuscules et chiffres
	if(strlen($pwd)<8 
		|| strlen($pwd)>25
		|| !preg_match("#[a-z]#", $pwd)
		|| !preg_match("#[0-9]#", $pwd)
		|| !preg_match("#[A-Z]#", $pwd)){
		$error = true;
		$listOfErrors[] = "Le mot de passe doit faire entre 8 et 25 caractères avec des minuscules, des majuscules et des chiffres";
	}


	//pwdConfirm : correspond à pwd
	if( $pwd != $pwdConfirm){
		$error = true;
		$listOfErrors[] = "Le mot de passe de confirmation ne correspond pas";
	}



	//email : format valide
	if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
		$error = true;
		$listOfErrors[] = "L'email n'est pas valide";
	}else if(!$error){
		//Connexion à la base de données
		$pdo = connectDB();
		$query = "SELECT id FROM users WHERE email = :email";
		$queryPrepared = $pdo->prepare($query);
		$queryPrepared->execute([ ":email"=> $email]);

		$result = $queryPrepared->fetch();

		if( !empty($result)){
			$error = true;
			$listOfErrors[] = "L'email existe déjà";
		}

	}



	//if($error == true){
	if($error){
		
		unset($_POST["inputPassword"]);
		unset($_POST["confirmPassword"]);


		$_SESSION["errors"] = $listOfErrors;
		$_SESSION["errorsInput"] = $_POST;
		

		//Redirection register.php avec les messages d'erreurs
		header("Location: register.php");
		

	}else{
		
		$query = "INSERT INTO users 
		(firstname, lastname, email, pwd) 
		VALUES 
		(:firstname , :lastname , :email , :pwd)";


		$pwd = password_hash($pwd, PASSWORD_DEFAULT );


		$queryPrepared = $pdo->prepare($query);
		$queryPrepared->execute( 
			[	
				":firstname"=>$firstName, 
				":lastname"=>$lastName, 
				":email"=>$email, 
				":pwd"=>$pwd
			] );

		//Hash mot de passe
		//Insertion en BDD
		//Redirection login.php
		header("Location: login.php");
	}


}else{
	die("Tentative de Hack .... !!!!");
}








