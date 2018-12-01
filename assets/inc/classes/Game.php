<?php

  class Game {

    public function createGame() {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
      $userObj = new User();

      $user_id = $userObj->getUserId();
      $game_code = "";
      $chars = "123456789";

      for($i = 0; $i < 6; $i++) {

        $game_code .= $chars[rand(0, strlen($chars) - 1)];

      }

      $exc = $mysqli->prepare("DELETE FROM `games` WHERE `hoster_id`=?");
      $exc->bind_param("i", $user_id);
      $exc->execute();
      $exc->close();

      $exc = $mysqli->prepare("INSERT INTO `games`(`game_code`, `hoster_id`) VALUES (?, ?)");
      $exc->bind_param("si", $game_code, $user_id);
      $exc->execute();
      $exc->close();

      return $game_code;

    }

    public function getPlayersForGame($game_code) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `members` FROM `games` WHERE `game_code`=?");
      $exc->bind_param("s", $game_code);
      $exc->execute();
      $exc->bind_result($players);
      $exc->fetch();

      return json_decode($players);

    }

    public function kickUser($userID, $game_code) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $players = $this->getPlayersForGame($game_code);

      for($i = 0; $i < count($players); $i++) {

        for($j = 0; $j < count($players[$i]); $j++) {

          if($players[$i][$j] == $userID) {

            array_splice($players[$i], $j, 1);

          }

        }

      }

      $updatedArray = json_encode($players);

      $exc = $mysqli->prepare("UPDATE `games` SET `members`=? WHERE `game_code`=?");
      $exc->bind_param("ss", $updatedArray, $game_code);
      $exc->execute();
      $exc->close();

    }

    public function setCollection($game_code, $collection_id) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("UPDATE `games` SET `collection_id`=? WHERE `game_code`=?");
      $exc->bind_param("is", $collection_id, $game_code);
      $exc->execute();
      $exc->close();

    }

    public function getCollectionForGame($game_code) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `collection_id` FROM `games` WHERE `game_code`=?");
      $exc->bind_param("s", $game_code);
      $exc->execute();
      $exc->bind_result($collection_id);
      $exc->fetch();
      $exc->close();

      return $collection_id;

    }

    public function validateGameCode($game_code) {

      $userObj = new User();
      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $userID = $userObj->getUserId();

      $exc = $mysqli->prepare("SELECT `id` FROM `games` WHERE `game_code`=?");
      $exc->bind_param("s", $game_code);
      $exc->execute();
      $exc->store_result();

      if($exc->num_rows > 0) {

        $exc->close();

        $exc = $mysqli->prepare("SELECT `hoster_id` FROM `games` WHERE `game_code`=?");
        $exc->bind_param("s", $game_code);
        $exc->execute();
        $exc->bind_result($hoster_id);
        $exc->fetch();
        $exc->close();

        if($hoster_id == $userID) {

          return "You cannot join your own game!";

        }else {

          return "true";

        }

      }else {

        return "Invalid game code!";

      }

    }

    public function exists($game_code) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `id` FROM `games` WHERE `game_code`=?");
      $exc->bind_param("s", $game_code);
      $exc->execute();
      $exc->store_result();

      if($exc->num_rows > 0) {

        return true;

      }else {

        return false;

      }

    }

    public function joinGame($game_code, $nickname) {

      $userObj = new User();
      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $userID = $userObj->getUserId();

      $exc = $mysqli->prepare("SELECT `hoster_id` FROM `games` WHERE `game_code`=?");
      $exc->bind_param("s", $game_code);
      $exc->execute();
      $exc->bind_result($hoster_id);
      $exc->fetch();
      $exc->close();

      if($hoster_id == $userID) {

        return "You cannot join your own game!";

      }

      $players = array();
      $players = $this->getPlayersForGame($game_code);

      $exc = $mysqli->prepare("UPDATE `users` SET `current_nickname`=? WHERE `id`=?");
      $exc->bind_param("si", $nickname, $userID);
      $exc->execute();
      $exc->close();

      $team1 = $players[0];
      $team2 = $players[1];
      $team3 = $players[2];
      $team4 = $players[3];

      if(!in_array($userID, $team1) && !in_array($userID, $team2) && !in_array($userID, $team3) && !in_array($userID, $team4)) {

        if(count($team1) == 0) {

          array_push($team1, $userID);

        }else if(count($team1) > count($team2)) {

          array_push($team2, $userID);

        }else if(count($team2) > count($team3)) {

          array_push($team3, $userID);

        }else if(count($team3) > count($team4)) {

          array_push($team4, $userID);

        }else {

          array_push($team1, $userID);

        }

      }

      $updatedPlayers = array($team1, $team2, $team3, $team4);

      $updatedArray = json_encode($updatedPlayers);

      $exc = $mysqli->prepare("UPDATE `games` SET `members`=? WHERE `game_code`=?");
      $exc->bind_param("ss", $updatedArray, $game_code);
      $exc->execute();
      $exc->close();

      return "true";

    }

    public function getPlayerCountForGame($game_code) {

      return count($this->getPlayersForGame($game_code)[0]) + count($this->getPlayersForGame($game_code)[1]) + count($this->getPlayersForGame($game_code)[2]) + count($this->getPlayersForGame($game_code)[3]);

    }

  }

 ?>
