<?php

function login($user) {
	$token = createToken();
	$_SESSION["token"] = $token;
	$_SESSION["userid"] = $user["id"];
	$_SESSION["email"] = $user["email"];

	$_SESSION["uuid_discord"] = $user["uuid_discord"];

	$SQL = "UPDATE users SET 
            token= '".$token."'  
            WHERE id=".$user["id"]." 
            AND email='".$user["email"]."'";
    $result = db_execute($SQL);
	 	if(!empty($result)) $_SESSION["auth"] = true;
}

function createToken() {
	$token = md5(uniqid()."jq2à,?".time());
	$token = substr($token, 0, rand(10,20));
	$token = str_shuffle($token);
	return $token;
}

function isConnected() {
	//Est ce que les sessions existent
	if( !empty($_SESSION["token"]) 
		&& !empty($_SESSION["userid"]) 
		&& !empty($_SESSION["email"])
		&& !empty($_SESSION["uuid_discord"]) ){
		//-> si oui
		//comparaison des variables de session avec la bdd
		$SQL = "SELECT id FROM users WHERE token='".$_SESSION["token"]."' AND id=".$_SESSION["userid"]." AND email='".$_SESSION["email"]."';";
			$result = db_query($SQL)[0];

		if(!empty($result)){
			//-> si oui
			//Nouveau token
			$user = ["id"=>$_SESSION["userid"], "uuid_discord"=>$_SESSION["uuid_discord"], "email"=>$_SESSION["email"]];
			login($user);
			return true;
		}
	}
	return false;
}