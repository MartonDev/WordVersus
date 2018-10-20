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

  }

 ?>
