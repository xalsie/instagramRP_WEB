<?php
if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
  $path = "C:/wamp64/www/intagramRP_WEB";
} else {
  $path = $_SERVER["DOCUMENT_ROOT"];
}

  include_once($path."/includes/inc.php");

  date_default_timezone_set('UTC');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    global $values;

    foreach($_POST as $key=>$value){
      echo $key;
      $values = $key;
    }

    $data = json_decode($values, true);

    switch ($data['action']) {
      case "addPicture":
        $uuid = db_escape($data['uuid']);
        $date_create = db_escape(date("Y-m-d H:i:s", $data['date_create']));
        $date_modification = db_escape($data['date_modification']);
        $discord_link = db_escape(str_replace("_", ".", $data['discord_link']));
        $discord_name_id = db_escape($data['discord_name_id']);
        $discord_name = db_escape($data['discord_name']);
        $date_post = db_escape(date("Y-m-d H:i:s", $data['date_post']));
        $commentaire = db_escape($data['commentaire']);


        $sql_search_name = "SELECT `id` FROM `discord_users` WHERE `discord_id` = '{$discord_name_id}' AND `discord_name` = '{$discord_name}';";
            $idUser=db_query($sql_search_name);
          
        if (empty($idUser)) {
          $sql = "INSERT INTO `discord_users` (`date_create`, `date_modification`, `discord_id`, `discord_name`) VALUES (now(), now(), '$discord_name_id', '{$discord_name}');";
            $result=db_execute($sql);
            $idUser=db_query($sql_search_name);
        }

        $sql="INSERT INTO `image_db_storage` (`uuid`, `date_create`, `date_modification`, `name`, `path`, `discord_link`, `ref_discord_users`, `discord_name`, `date_post`, `commentaire`)
        VALUES ('{$uuid}', now(), now(), NULL, NULL, '{$discord_link}', '{$idUser[0]["id"]}', '{$discord_name}', now(), '{$commentaire}');";
        $result=db_execute($sql);


        echo 'OK';
        break;
      case "addReact":
        // date_create	date_modification	uuid	discord_name	discord_id	emoji

        $uuid = db_escape($data['uuid']);
        $discord_name_id = db_escape($data['discord_name_id']);
        $discord_name = db_escape($data['discord_name']);
        $discord_emoji = db_escape($data['discord_emoji']);

        $sql="INSERT INTO `react_discord` (`uuid`, `date_create`, `date_modification`, `discord_id`, `discord_name`, `emoji`)
        VALUES ('{$uuid}', now(), now(), '{$discord_name_id}', '{$discord_name}', '{$discord_emoji}');";
          $result=db_execute($sql);

        echo 'OK';
        break;
      case "removeReact":

        $uuid = db_escape($data['uuid']);
        $discord_name_id = db_escape($data['discord_name_id']);
        $discord_name = db_escape($data['discord_name']);

        $sql = "DELETE FROM `react_discord` WHERE `uuid` = '{$uuid}' AND `discord_name` = '{$discord_name}' AND `discord_id` = '{$discord_name_id}';";
          $result=db_execute($sql);

        echo 'OK';
        break;
    }
    exit;
  }
?>