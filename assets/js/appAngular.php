<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
    $path = "C:/wamp64/www/intagramRP_WEB";
} else {
    $path = $_SERVER["DOCUMENT_ROOT"];
}
include_once($path."/includes/inc.php");

if (!isConnected()) {
    return false;
}

switch($_GET['action']) {
    case 'getUser':
        $SQL = "SELECT `id`, `nameRP`, `nameDiscord` FROM `users`
            WHERE id=".$_SESSION["userid"]." 
            AND email='".$_SESSION["email"]."'
            AND token='".$_SESSION["token"]."'";
        $result = db_query($SQL)[0];

        echo json_encode([$result, $_SESSION["auth"]]);
    break;
}


?>