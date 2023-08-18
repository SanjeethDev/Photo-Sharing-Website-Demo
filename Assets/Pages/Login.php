<!DOCTYPE html>
<html>
  <span id="currentPgId" hidden>Login</span>
  <head>
    <link rel="stylesheet" type="text/css" href="/../../styles.css">
    <script type="text/javascript" src="/navActive.js"></script>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."header.php") ?>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."favicon.php") ?>
    <script>
      function showPassword() {
        var x = document.getElementById("userPassword_id");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </head>
  <body onload="navActive()">
    <div class="contact" id="contactdivid">
      <div style="padding: 10%;">
        <center>
        <form action="loginAuth.php" method="post" autocomplete="off">
          <table>
            <tr>
              <td colspan="2" style="text-align: center;">
                <p style="color: rgb(213, 69, 69);">
                  <?php
                  if (isset($_POST['message'])) {
                    echo htmlspecialchars($_POST['message']);
                  } else {
                    echo "";
                  }
                   ?>
                </p>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input size="41" id="userName_id" type="text" name="userName" value="<?php
                  if (isset($_POST['username'])) {
                    echo htmlspecialchars($_POST['username']);
                  } else {
                    echo "";
                  }
                 ?>" style="width: 100%;" required>
                <label for="userName">Username</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <?php
                  if (isset($_POST['password'])) {
                    echo "<input id='userPassword_id' type='password' name='userPassword' value='".htmlspecialchars($_POST['password'])."' required>";
                  } else {
                    echo "<input id='userPassword_id' type='password' name='userPassword' required>";
                  }
                 ?>
                <label for="userPassword">Password</label>
                <div class="password_options">
                  <input type="checkbox" onclick="showPassword()" style="float:left; width:auto; padding: 0;">
                  <span style="float:left; padding:5px; margin:0;">Show Password</span>
                </div>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2"   align="center">
                <button type="submit" name="login">Login</button>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <a id="createAccount" href="/Assets/Pages/createAccount.php">Create account</a>
              </td>
            </tr>
          </table>
        </form>
        </center>
      </div>
    </div>
  </body>
</html>
