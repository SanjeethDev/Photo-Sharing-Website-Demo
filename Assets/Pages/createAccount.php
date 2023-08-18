<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/../../styles.css">
    <script type="text/javascript" src="/navActive.js"></script>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."favicon.php") ?>
  </head>
  <body onload="navActive()">
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."header.php") ?>
    <?php
      if(isset($_POST['create'])) {
        $username = $_POST['userName'];
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $sql = new mysqli('localhost:3307','root','','aperture');
        $sql -> query("INSERT INTO user_accounts VALUES (NULL, '$username', '$email', '$password')");
        $sql -> close();
        unset($_POST['create']);
        header("Location: /Assets/Pages/Login.php");
      }
    ?>
    <script type="text/javascript">
      function checkValidUN() {
        var inputE = document.getElementById('userName_id').value;
        inputE = inputE.toLowerCase();
        if (inputE == "") {
          document.getElementById('userNameMsg_id').innerHTML = 'Enter Username';
        } else {
          $.ajax({
            type: "POST",
            url: "/Assets/Pages/checkinUEDB.php",
            data:{checkInput: "username='" + inputE + "'"},
            success: function(response) {
              if (response == 1) {
                document.getElementById('userNameMsg_id').innerHTML = 'Username not available.';
                document.getElementById('userName_id').style.borderBottom = '2px solid #ff416f';
                document.getElementById('accountSubmit_id').style.background = "grey";
                document.getElementById('accountSubmit_id').disabled = true;
              } else {
                document.getElementById('userNameMsg_id').innerHTML = 'Enter Username';
                document.getElementById('userName_id').style.borderBottom = '2px solid #41ffaa';
                document.getElementById('accountSubmit_id').disabled = false;
                document.getElementById('accountSubmit_id').style.background = 'url("/Assets/Image_Resources/header_background.png")';
              }
            }
          });
        }
      }

      function checkValidEM() {
        var inputE = document.getElementById('userEmail_id').value;
        inputE = inputE.toLowerCase();
        if (inputE.includes("@gmail.com")) {
          $.ajax({
            type: "POST",
            url: "/Assets/Pages/checkinUEDB.php",
            data:{checkInput: "email='" + inputE + "'"},
            success: function(response) {
              if (response == 1) {
                document.getElementById('userEmailMsg_id').innerHTML = 'Account already exists.';
                document.getElementById('accountSubmit_id').style.background = "grey";
                document.getElementById('accountSubmit_id').disabled = true;
              } else {
                document.getElementById('userEmailMsg_id').innerHTML = 'Enter Email';
                document.getElementById('userEmail_id').style.borderBottom = '2px solid #41ffaa';
                document.getElementById('accountSubmit_id').style.background = 'url("/Assets/Image_Resources/header_background.png")';
                document.getElementById('accountSubmit_id').disabled = false;
              }
            }
          });
        } else if (inputE == "") {
          document.getElementById('userEmailMsg_id').innerHTML = 'Enter Email';
        } else {
          document.getElementById('userEmail_id').style.borderBottom = '2px solid #ff416f';
        }
      }

      function inblurCheck(element) {
        if (document.getElementById('userName_id').value == '' && element.id == 'userNameMsg_id') {
          element.innerHTML = 'Enter Username';
          document.getElementById('userName_id').style.borderBottom = '2px solid #417fb8';
        } else if (document.getElementById('userEmail_id').value == '' && element.id == 'userEmailMsg_id') {
          element.innerHTML = 'Enter Email';
          document.getElementById('userEmail_id').style.borderBottom = '2px solid #417fb8';
        }
      }
    </script>
    <div class="contact" id="contactdivid">
      <div>
        <center>
        <form action="" method="post" autocomplete="off">
          <table>
            <tr>
              <td colspan="2" align="center">Create Account</td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input size="41" id="userName_id" type="text" name="userName" oninput="checkValidUN();" onblur="inblurCheck(this.nextSibling.nextSibling);" style="width: 100%;" required>
                <label for="userName" id="userNameMsg_id">Enter Username</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input id="userEmail_id" type="email" name="userEmail" oninput="checkValidEM();" onblur="inblurCheck(this.nextSibling.nextSibling);" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                <label for="userEmail" id="userEmailMsg_id">Enter Email</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input id="userPassword_id" type="password" name="userPassword" required>
                <label for="userPassword">Enter Password</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input id="confirmPassword_id" type="password" name="confirmPassword" required>
                <label for="confirmPassword">Confirm Password</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2"   align="center">
                <button type="submit" name="create" id="accountSubmit_id">Create</button>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <p id="msg_id"></p>
              </td>
            </tr>
          </table>
        </form>
        </center>
      </div>
    </div>
  </body>
</html>
