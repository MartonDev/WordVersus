<?php

  session_start();

  require '../config.inc.php';
  require '../classes/User.php';
  require '../classes/Collection.php';
  require '../classes/Game.php';

  $userObj = new User();
  $collectionObj = new Collection();
  $gameObj = new Game();

  echo $gameObj->getPlayerCountForGame($_GET["game_code"]);

 ?>
