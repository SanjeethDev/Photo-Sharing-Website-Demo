<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/Project/styles.css">
  </head>
  <body class="cs_body">
    <center>
    <div style="padding: 25px;">
    <?php

    ?>
     <!-- INSERT INTO `contact` (`firstname`, `lastname`, `email`, `subject`, `message`) VALUES ('Sanjeeth', 'Dev', 'dev.sanjeeth@gmail.com', 'Test Subject', 'Test Message'); -->
    <table style="background-color: rgba(0, 0, 0, 0.7); padding: 25px; border-radius: 25px;">
      <tr>
        <td><h2 class='cs_text'>First Name: </h2></td><td><h2 class='cs_text' style='color:#ff2424;'><?php echo $firstname ?></h2></td>
      </tr>
      <tr>
        <td><h2 class='cs_text'>Last Name: </h2></td><td><h2 class='cs_text' style='color:#ff2424;'><?php echo $lastname ?></h2></td>
      </tr>
      <tr>
        <td><h2 class='cs_text'>Email: </h2></td><td><h2 class='cs_text' style='color:#ff2424;'><?php echo $email ?></h2></td>
      </tr>
      <tr>
        <td><h2 class='cs_text'>Subject: </h2></td><td><h2 class='cs_text' style='color:#ff2424;'><?php echo $subject ?></h2></td>
      </tr>
      <tr>
        <td><h2 class='cs_text'>Message: </h2></td><td><h2 class='cs_text' style='color:#ff2424;'><?php echo $message ?></h2></td>
      </tr>
      <tr>
        <td colspan="2"><center><button onclick="window.location='/Main.php'" style="font-size: 20px;">Back</button></center></td>
      </tr>
    </table>
   </div>
 </center>
  </body>
</html>
