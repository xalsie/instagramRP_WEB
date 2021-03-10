<?php
	if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
		$path = "C:/wamp64/www/intagramRP_WEB";
	} else {
		$path = $_SERVER["DOCUMENT_ROOT"];
	}

	include_once($path."/includes/inc.php");

	//àéè
	defined('vSecureInstaRP') or header('Location: /');

if( count($_POST) == 5
 && !empty($_POST["namePR"]) 
 && !empty($_POST["nameDiscord"]) 
 && !empty($_POST["inputEmail"]) 
 && !empty($_POST["inputPassword"]) 
 && !empty($_POST["confirmPassword"]) ){


	//Nettoyer les champs
	$namePR = ucwords(trim($_POST["namePR"]));
	$nameDiscord = trim($_POST["nameDiscord"]);
	$email = strtolower(trim($_POST["inputEmail"]));
	$pwd = $_POST["inputPassword"];
	$pwdConfirm = $_POST["confirmPassword"];

	//Vérification des champs

	$error = false;
	$listOfErrors = [];

	//namePR : entre 2 et 50
	if(strlen($namePR)<2 || strlen($namePR)>50){
		$error = true;
		$listOfErrors[] = "Le prenom doit faire entre 2 et 50 caractères";
	}


	//nameDiscord : entre 2 et 100
	if(strlen($nameDiscord)<2 || strlen($nameDiscord)>100){
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
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = true;
		$listOfErrors[] = "L'email n'est pas valide";
	} else if(!$error){
		//Connexion à la base de données
		// $pdo = connectDB();
		// $query = "SELECT id FROM users WHERE email = :email";
		// $queryPrepared = $pdo->prepare($query);
		// $queryPrepared->execute([ ":email"=> $email]);

		// $result = $queryPrepared->fetch();

		$SQL = "SELECT id FROM users WHERE email = '".db_escape($email)."';";
			$result = db_query($SQL);

		if(!empty($result)){
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
		
		// $query = "INSERT INTO users 
		// (namePR, nameDiscord, email, pwd) 
		// VALUES 
		// (:namePR , :nameDiscord , :email , :pwd)";

		$pwd = password_hash($pwd, PASSWORD_DEFAULT );

		// // echo $query;
		// $queryPrepared = $pdo->prepare($query);
		// $queryPrepared->execute([	
		// 		":namePR"=>$namePR, 
		// 		":nameDiscord"=>$nameDiscord, 
		// 		":email"=>$email, 
		// 		":pwd"=>$pwd
		// 	]);

		$SQL = "INSERT INTO `users` (`date_create`, `date_modification`, `nameRP`, `nameDiscord`, `email`, `check_email`, `password`, `date_modification_pw`) VALUES (now(), now(), '".$namePR."', '".db_escape($nameDiscord)."', '".db_escape($email)."', '0', '".$pwd."', now());";
			$result = db_execute($SQL);

		//Hash mot de passe
		//Insertion en BDD
		//Redirection login.php
		header("Location: /intagramRP_WEB/Administration/login.php");
	}


}else{
	die("Tentative de Hack .... !!!!");
}








