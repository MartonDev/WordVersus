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

       <div class="waiting-div" id="waitingdiv" style="display:none;">

         <div class="sk-cube-grid">

            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>

          </div>

          <h1>Waiting for the hoster to start the game...</h1>

       </div>

     </div>

   </div>

 </div>

 <script>

    var pastvalue = "";
    var waitingForTeacher = false;
    var kickUser = false;

    $('#firstpart').focus();

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

      if(waitingForTeacher) {

        var code = $("#firstpart").val() + $("#secondpart").val();

        $.get("../../assets/inc/lives/ispartofgame.php", {game_code: code}, function(data) {

          if(data == "") {

            if(!kickUser) {

              code = "";
              kickUser = true;
              waitingForTeacher = false;
              document.getElementById("gamecode").style.display = "block";
              document.getElementById("nicknamediv").style.display = "none";
              document.getElementById("waitingdiv").style.display = "none";
              $("#gamecode").removeClass("bounceOutLeft");
              $("#gamecode").addClass("animated bounceInLeft");
              $("#gamecode").css("animation-fill-mode", "none");
              $("#gamecode").css("-webkit-animation-fill-mode", "none");
              $("#firstpart").focus();
              $("#nicknameinput").val("");
              notifyUser("Info", "You have been kicked from the game!", 7000);

            }

          }else {

            //code to test if game is starting and show new screen thught the loading.php file

          }

        });

      }

    }, 100);

    $('#joinGame').click(function() {

      var code = $("#firstpart").val() + $("#secondpart").val();

      $.get("../../assets/inc/lives/validatecode.php", {game_code: code}, function(data) {

        if(data == "true") {

          $("#gamecode").addClass("animated bounceOutLeft");
          document.getElementById("nicknamediv").style.display = "block";
          $("#nicknamediv").addClass("animated bounceInRight");

          setTimeout(function(){

            document.getElementById("gamecode").style.display = "none";

          }, 600);

        }else {

          notifyUser("Info", data, 6000);

        }

      });

    });

    $('#setNickname').click(function() {

      var code = $("#firstpart").val() + $("#secondpart").val();
      var nickname = $("#nicknameinput").val();

      $.get("../../assets/inc/lives/joingame.php", {game_code: code, nickname: nickname}, function(data) {

        if(data == "true") {

          $("#nicknamediv").addClass("animated bounceOutLeft");
          document.getElementById("waitingdiv").style.display = "block";
          $("#waitingdiv").addClass("animated bounceInRight");
          waitingForTeacher = true;
          kickUser = false;

          setTimeout(function(){

            document.getElementById("nicknamediv").style.display = "none";

          }, 600);

        }else {

          notifyUser("Info", data, 6000);

        }

      });

    });

    $(window).on('beforeunload', function () {

      return 'You haven\'t saved your changes.';

    });

 </script>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
