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

      header("Location: ../index.php");
      die();

    }

    public function signUp($username, $email, $password) {



    }

    public function resetPassword($email) {



    }

    public function changePassword($currentPassword, $newPassword) {



    }

  }

 ?>
