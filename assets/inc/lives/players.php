<?php

  require '../config.inc.php';
  require '../classes/User.php';
  require '../classes/Collection.php';
  require '../classes/Game.php';

  $userObj = new User();
  $collectionObj = new Collection();
  $gameObj = new Game();

  $players = $gameObj->getPlayersForGame($_GET["game_code"]);

  for($i = 0; $i < count($players); $i++) {

    echo '<a onclick="kickUser(' . $players[$i] . ');">' . $userObj->getNicknameForUser($players[$i]) . '</a><br />';

  }

 ?>
