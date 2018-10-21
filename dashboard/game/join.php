<?php

  $page = "Dashboard";

  require '../../assets/inc/header.inc.php';
  require '../../assets/inc/classes/Collection.php';
  require '../../assets/inc/classes/Game.php';

  $gameObj = new Game();

 ?>

 <div class="dashboard">

   <div class="sidenav">

     <div class="menu">

       <a href="../index.php"><i class="fas fa-home"></i></a>
       <a href="../profile.php"><i class="fas fa-user"></i></a>
       <a href="../settings.php"><i class="fas fa-cog"></i></a>
       <a href="?logout=1"><i class="fas fa-sign-out-alt"></i></a>

       <img class="logo" src="../../assets/img/icon.png" />

     </div>

   </div>

   <div class="container">

     <div class="main" style="height: 70vh; position: relative;">

       <h1 class="title">Join game</h1>

       <div class="game-code" id="gamecode">

         <input id="firstpart" type="text" maxlength="3" placeholder="123" class="code-input" />
         <i class="input-seperator fas fa-minus"></i>
         <input id="secondpart" type="text" maxlength="3" placeholder="456" class="code-input" />

         <button class="add-btn" id="joinGame" disabled><i class="fas fa-paper-plane"></i> Join game</button>

       </div>

       <div class="nickname-div" id="nicknamediv" style="display:none;">

         <input id="nicknameinput" type="text" placeholder="Enter a nickname" class="nickname-input" />
         <button class="add-btn" id="setNickname" disabled>Set nickname</button>

       </div>

     </div>

   </div>

 </div>

 <script>

    var pastvalue = "";

    setInterval(function() {

      if($('#firstpart').val().replace(/\s+/g, '').length == 3 && pastvalue != $('#firstpart').val()) {

        $('#secondpart').focus();
        pastvalue = $('#firstpart').val();

      }

      if($('#firstpart').val().replace(/\s+/g, '').length == 3 && $('#secondpart').val().replace(/\s+/g, '').length == 3) {

        $('#joinGame').prop('disabled', false);

      }else {

        $('#joinGame').prop('disabled', true);

      }

      if($('#nicknameinput').val() != "") {

        $('#setNickname').prop('disabled', false);

      }else {

        $('#setNickname').prop('disabled', true);

      }

    }, 100);

    $('#joinGame').click(function() {

      var code = $("#firstpart").val() + $("#secondpart").val();

      $.get("../../assets/inc/lives/validatecode.php", {game_code: code}, function(data) {

        if(data == 1) {

          $("#gamecode").addClass("animated bounceOutLeft");
          document.getElementById("nicknamediv").style.display = "block";
          $("#nicknamediv").addClass("animated bounceInRight");
          $("#nicknamediv").css("animation-fill-mode", "none");
          $("#nicknamediv").css("-webkit-animation-fill-mode", "none");

          setTimeout(function(){

            document.getElementById("gamecode").style.display = "none";

          }, 1000);

        }else {

          notifyUser("Info", "Wrong game code!", 6000);

        }

      });

    });

    $('#setNickname').click(function() {

      var code = $("#firstpart").val() + $("#secondpart").val();
      var nickname = $("#nicknameinput").val();

      $.get("../../assets/inc/lives/joingame.php", {game_code: code, nickname: nickname}, function(data) {

        if(data == 1) {

          console.log("Joined");

        }else {

          notifyUser("Info", "Something went wrong!", 6000);

        }

      });

    });

 </script>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
