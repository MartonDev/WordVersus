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

  if($gameObj->getPlayerCountForGame($_GET["game_code"]) > 0) {

    echo '<div class="team-div"><h1>Team #1</h1>';

    for($j = 0; $j < count($players[0]); $j++) {

      echo '<a class="player-kicker" onclick="kickUser(' . $players[0][$j] . ');">' . $userObj->getNicknameForUser($players[0][$j]) . '<div class="kicker-tooltip">Kick player!</div></a><br />';

    }

    echo '</div>';

  }

  if($gameObj->getPlayerCountForGame($_GET["game_code"]) > 1) {

    echo '<div class="team-div"><h1>Team #2</h1>';

    for($j = 0; $j < count($players[1]); $j++) {

      echo '<a class="player-kicker" onclick="kickUser(' . $players[1][$j] . ');">' . $userObj->getNicknameForUser($players[1][$j]) . '<div class="kicker-tooltip">Kick player!</div></a><br />';

    }

    echo '</div>';

  }

  if($gameObj->getPlayerCountForGame($_GET["game_code"]) > 2) {

    echo '<div class="team-div"><h1>Team #3</h1>';

    for($j = 0; $j < count($players[2]); $j++) {

      echo '<a class="player-kicker" onclick="kickUser(' . $players[2][$j] . ');">' . $userObj->getNicknameForUser($players[2][$j]) . '<div class="kicker-tooltip">Kick player!</div></a><br />';

    }

    echo '</div>';

  }

  if($gameObj->getPlayerCountForGame($_GET["game_code"]) > 3) {

    echo '<div class="team-div"><h1>Team #4</h1>';

    for($j = 0; $j < count($players[3]); $j++) {

      echo '<a class="player-kicker" onclick="kickUser(' . $players[3][$j] . ');">' . $userObj->getNicknameForUser($players[3][$j]) . '<div class="kicker-tooltip">Kick player!</div></a><br />';

    }

    echo '</div>';

  }

 ?>
