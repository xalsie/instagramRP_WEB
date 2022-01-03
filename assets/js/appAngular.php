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
    return "Error not connect!";
}

switch($_GET['action']) {
    case 'getUser':
        $SQL = "SELECT U.`compteName`, DU.`discord_name` FROM users AS U
            LEFT JOIN discord_users AS DU
            ON U.uuid_discord = DU.discord_id
            WHERE U.id = ".$_SESSION["userid"]."
            AND U.email='".$_SESSION["email"]."'
            AND U.token='".$_SESSION["token"]."';";
        $result = db_query($SQL)[0];

        echo json_encode([$result, $_SESSION["auth"]]);
    break;

    case 'getImgProfile':
        $limit = db_escape($_GET["limit"]);

        $SQL = "SELECT t1.id, t1.uuid, t1.discord_link, COUNT(t3.id) AS totalLike, t2.discord_name, t1.date_post, t1.commentaire
            FROM `image_db_storage` AS t1
            INNER JOIN discord_users AS t2 ON t1.ref_discord_users = t2.id
            LEFT JOIN react_discord AS t3 ON t1.uuid = t3.uuid
        
            WHERE t1.ref_discord_users = (SELECT DUS.`id` FROM `discord_users` AS DUS
            WHERE DUS.discord_id='".$_SESSION["uuid_discord"]."')
        
            GROUP BY t1.uuid
            ORDER BY `date_post`
            DESC
            LIMIT 0, ".$limit.";";
            $result = db_query($SQL);

        echo json_encode($result);
    break;
}
