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

    public function getGame($game_code) {



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

        if($players[$i] == $userID) {

          array_splice($players, $i, 1);

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

      if(!in_array($userID, $players)) {

        array_push($players, $userID);

      }

      $updatedArray = json_encode($players);

      $exc = $mysqli->prepare("UPDATE `games` SET `members`=? WHERE `game_code`=?");
      $exc->bind_param("ss", $updatedArray, $game_code);
      $exc->execute();
      $exc->close();

      return "true";

    }

  }

 ?>
