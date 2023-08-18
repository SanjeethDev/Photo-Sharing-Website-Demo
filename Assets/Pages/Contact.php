<!DOCTYPE html>
<html>
  <span id="currentPgId" hidden>Contact</span>
  <head>
    <link rel="stylesheet" type="text/css" href="/../../styles.css">
    <script type="text/javascript" src="/navActive.js"></script>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."favicon.php") ?>
    <script>
    function checkemailinput() {
      var value = document.getElementById("emailid").innerHTML.value;
      if(value != "") {
        document.getElementById("emailid").className = "emailspclass";

      }
    }
    </script>
  </head>
  <body onload="navActive()">
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."header.php") ?>
    <?php
      if(isset($_POST['submit']))
      {
        date_default_timezone_set("Asia/Kolkata");
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $date = date("Y-m-d h:i:s");
        $sql = new mysqli('localhost:3307','root','','aperture');
        $result = $sql -> query("SELECT * FROM contact");
        if($insert = $sql -> query("INSERT INTO contact VALUES('$firstname','$lastname','$email','$subject','$message','$date')"))
        {
          echo "<div id='sentMsg_id'>Message Sent!</div>";
        } else {
          echo "";
        }
        $result -> free_result();
        $sql -> close();
      }
    ?>
    <div class="contact" id="contactdivid">
      <div class="contact_form">
        <center>
        <form action="" method="post" autocomplete="off">
          <table>
            <tr>
              <td id="ctfo_id">
                <input id="firstnameid" type="text" name="firstname"  style="width: 90%;" required>
                <label for="firstname">First Name</label>
              </td>
              <td id="ctfo_id">
                <input id="lastnameid" type="text" name="lastname" value="" required>
                <label for="lastname">Last Name</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input id="emailid" type="email" name="email" value="" style="width: 100%;" required oninput="checkemailinput()">
                <label for="email">Email Address *</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <input id="subjectid" type="text" name="subject" value="" required>
                <label for="subject">Subject *</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2">
                <textarea id="messageid" name="message" cols="50" rows="10" style="resize: none; padding-top: 25px;padding-bottom: 25px;" maxlength="1000" required></textarea>
                <label for="message">Message *</label>
              </td>
            </tr>
            <tr>
              <td id="ctfo_id" colspan="2" align="center">
                <button type="submit" name="submit">Submit</button>
              </td>
            </tr>
          </table>
        </form>
        </center>
      </div>
      <div class="contact_details">
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >Feedback and Enquires can be dropped down here. We look forward to hearing from you.</p>
        <br><br><br><br>
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >Facebook: </p>
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >https://www.facebook.com/Aperture</p>
        <br><br>
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >Twitter: </p>
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >https://www.twitter.com/Aperture</p>
        <br><br>
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >Youtube: </p>
        <p id="contact_rstext" class="cs_text" style="font-size: 18px;" >https://www.youtube.com/Aperture</p>
      </div>
    </div>
  </body>
</html>
