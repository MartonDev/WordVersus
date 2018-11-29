<?php

  class User {

    public function isLoggedIn() {

      if(isset($_SESSION["loggedIn"])) {

        return $_SESSION["loggedIn"];

      }else {

        return false;

      }

    }

    public function getUsername() {

      return $_SESSION["username"];

    }

    public function getUserId() {

      $username_to_bind = $this->getUsername();

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `id` FROM `users` WHERE `username`=?");
      $exc->bind_param("s", $username_to_bind);
      $exc->execute();
      $exc->bind_result($id_bind);
      $exc->fetch();

      return $id_bind;

    }

    public function getNicknameForUser($userID) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `current_nickname` FROM `users` WHERE `id`=?");
      $exc->bind_param("i", $userID);
      $exc->execute();
      $exc->bind_result($nickname);
      $exc->fetch();

      return $nickname;

    }

    public function getEmail() {

      $username_to_bind = $this->getUsername();

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `email` FROM `users` WHERE `username`=?");
      $exc->bind_param("s", $username_to_bind);
      $exc->execute();
      $exc->bind_result($email_bind);
      $exc->fetch();

      return $email_bind;

    }

    public function getProfilePicture($username) {

      $file = realpath(__DIR__ . '/../..') . "/img/avatars/" . $username;

      if(file_exists($file . ".png")) {

        return SITE_URL . "/assets/img/avatars/" . $username . ".png";

      }else if(file_exists($file . ".jpg")) {

        return SITE_URL . "/assets/img/avatars/" . $username . ".jpg";

      }else if(file_exists($file . ".jpeg")) {

        return SITE_URL . "/assets/img/avatars/" . $username . ".jpeg";

      }else if(file_exists($file . ".gif")) {

        return SITE_URL . "/assets/img/avatars/" . $username . ".gif";

      }else {

        return SITE_URL . "/assets/img/user.png";

      }

    }

    function logIn($username, $password) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `password` FROM `users` WHERE `username`=?");
      $exc->bind_param("s", $username);
      $exc->execute();
      $exc->bind_result($hashed_password);
      $exc->fetch();

      if(password_verify($password, $hashed_password)) {

        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $username;
        
        return true;

      }else {

        return false;

      }

    }

    public function logOut() {

      session_destroy();

      header("Location: " . SITE_URL);
      die();

    }

    public function signUp($username, $email, $password) {

      if($username == "" || $email == "" || $password == "") {

        return "Cannot be empty.";

      }

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `username` FROM `users` WHERE `username`=?");
      $exc->bind_param("s", $username);
      $exc->execute();
      $exc->store_result();

      if($exc->num_rows > 0) {

        return "Username already in use.";

      }else {

        $exc->close();

        $exc = $mysqli->prepare("SELECT `email` FROM `users` WHERE `email`=?");
        $exc->bind_param("s", $email);
        $exc->execute();
        $exc->store_result();

        if($exc->num_rows > 0) {

          return "Email already in use.";

        }else {

          $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

          $exc = $mysqli->prepare("INSERT INTO `users`(`username`, `password`, `email`) VALUES (?,?,?)");
          $exc->bind_param("sss", $username, $hashed_password, $email);
          $exc->execute();

          return 'You have successfuly registered. You can now log in.';

        }

      }

    }

    public function resetPassword($email) {



    }

    public function changePassword($currentPassword, $newPassword) {

      $username = $this->getUsername();

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `password` FROM `users` WHERE `username`=?");
      $exc->bind_param("s", $username);
      $exc->execute();
      $exc->bind_result($hashed_password);
      $exc->fetch();
      $exc->close();

      if(password_verify($currentPassword, $hashed_password)) {

        $new_hashed_password = password_hash($newPassword, PASSWORD_DEFAULT, ['cost' => 12]);

        $exc = $mysqli->prepare("UPDATE `users` SET `password`=? WHERE `username`=?");
        $exc->bind_param("ss", $new_hashed_password, $username);
        $exc->execute();

        return "Successfuly changed your password!";

      }else {

        return "Wrong current password!";

      }

    }

    public function changeEmail($email) {

      if($email != "") {

        $username = $this->getUsername();

        $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

        $exc = $mysqli->prepare("UPDATE `users` SET `email`=? WHERE `username`=?");
        $exc->bind_param("ss", $email, $username);
        $exc->execute();

        return "Successfuly changed email!";

      }else {

        return "Could not change email!";

      }

    }

    function getStat($stat_name) {

      $stats = array('wins' => 0, 'total_games' => 0, 'correct_words' => 0, 'wrong_words' => 0);
      $username = $this->getUsername();

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `wins`,`total_games`,`correct_words`,`wrong_words` FROM `users` WHERE `username`=?");
      $exc->bind_param("s", $username);
      $exc->execute();
      $exc->bind_result($stats["wins"], $stats["total_games"], $stats["correct_words"], $stats["wrong_words"]);
      $exc->fetch();

      if($stat_name == "") {

        return $stats;

      }else {

        return $stats[$stat_name];

      }

    }

  }

 ?>
