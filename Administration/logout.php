<?php
if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
    $path = "C:/wamp64/www/intagramRP_WEB";
} else {
    $path = $_SERVER["DOCUMENT_ROOT"];
}
include_once($path."/includes/inc.php");

// if (isConnected()) {
//     $query = "UPDATE web_users SET 
//             token= NULL  
//             WHERE id=".$_SESSION["userid"]." 
//             AND email='".$_SESSION["email"]."'";

//     $result = db_execute($SQL);
// }

session_destroy();
header("Location: ../index.php");
