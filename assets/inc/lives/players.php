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

  for($i = 0; $i < count($players); $i++) {

    for($j = 0; $j < count($players[$i]); $j++) {

      echo '<a class="player-kicker" onclick="kickUser(' . $players[$i][$j] . ');">' . $userObj->getNicknameForUser($players[$i][$j]) . '<div class="kicker-tooltip">Kick player!</div></a><br />';

    }

  }

 ?>
