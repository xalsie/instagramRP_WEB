<?php
require "conf.inc.php";
require "functions.php";
session_start();

if (isConnected()) {
    $query = "UPDATE web_users SET 
					token= NULL  
					WHERE id=".$_SESSION["userid"]." 
                    AND email='".$_SESSION["email"]."'";
    $pdo = connectDB();
    $pdo->query($query);
}

session_destroy();
header("Location: index.php");
