<?php

  session_start();

  require '../config.inc.php';
  require '../classes/User.php';
  require '../classes/Collection.php';
  require '../classes/Game.php';

  $userObj = new User();
  $collectionObj = new Collection();
  $gameObj = new Game();

  $players = $gameObj->getPlayersForGame($_GET["game_code"]);

  if(in_array($userObj->getUserId(), $players[0])) {

    echo in_array($userObj->getUserId(), $players[0]);

  }else if(in_array($userObj->getUserId(), $players[1])) {

    echo in_array($userObj->getUserId(), $players[1]);

  }else if(in_array($userObj->getUserId(), $players[2])) {

    echo in_array($userObj->getUserId(), $players[2]);

  }else if(in_array($userObj->getUserId(), $players[3])) {

    echo in_array($userObj->getUserId(), $players[3]);

  }else {

    echo in_array($userObj->getUserId(), $players[3]);

  }

 ?>
