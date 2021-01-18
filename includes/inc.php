<?php
	//àéè
	// A inclure dans les fichiers php :
	// 	define('vSecureProlivalChrono',"site");
	//  include_once("/var/www/html/SiteChrono/includes/inc.php");

	define('vSecureInstaRP',"site");
	
	if (empty(@$_SERVER["DOCUMENT_ROOT"])) {
		$path = "/var/www/html/InstaRP";
	} else {
		$path = $_SERVER["DOCUMENT_ROOT"]."/InstaRP";
	}

	session_start();

	// include_once("./db_connect/Connect.php");
	include_once($path."/includes/config.inc.php");
	$aConfig['db_host']=$dbhost;
	$aConfig['db_user']=$dbuser;
	$aConfig['db_password']=$dbpassword;
	$aConfig['db_name']=$database;
	
	include_once($path."/includes/db.inc.php");
	include_once($path."/includes/functions.inc.php");
	
	include_once($path."/includes/header.inc.php");
?>