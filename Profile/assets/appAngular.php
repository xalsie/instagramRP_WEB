<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
    $path = "C:/wamp64/www/intagramRP_WEB";
} else {
    $path = $_SERVER["DOCUMENT_ROOT"];
}
include_once($path."/includes/inc.php");

switch($_GET['action']) {
    case 'getUser':
        $userid = db_escape($_GET["userid"]);
        $noRegister = false;

        $SQL = "SELECT U.`compteName`, DU.`discord_name` FROM users AS U
            LEFT JOIN discord_users AS DU
            ON U.uuid_discord = DU.discord_id
            WHERE U.uuid_discord = '".$userid."';";
        $result = db_query($SQL);

        if (empty($result)) {
            $SQL = "SELECT DU.`discord_name` FROM discord_users AS DU
                WHERE DU.discord_id = '".$userid."';";
            $result = db_query($SQL);
            $noRegister = true;
        }

        echo json_encode([$noRegister, $result[0]]);
    break;
    case 'getImage':
        $userid = db_escape($_GET["userid"]);
        $limit = db_escape($_GET["limit"]);

        $SQL = "SELECT t1.id, t1.uuid, t1.discord_link, COUNT(t3.id) AS totalLike, t2.discord_name, t1.date_post, t1.commentaire
            FROM `image_db_storage` AS t1
            INNER JOIN discord_users AS t2 ON t1.ref_discord_users = t2.id
            LEFT JOIN react_discord AS t3 ON t1.uuid = t3.uuid
        
            WHERE t1.ref_discord_users = (SELECT DUS.`id` FROM `discord_users` AS DUS
            WHERE DUS.discord_id='".$userid."')
        
            GROUP BY t1.uuid
            ORDER BY `date_post`
            DESC
            LIMIT 0, ".$limit.";";
            $result = db_query($SQL);

        echo json_encode($result);
    break;
}