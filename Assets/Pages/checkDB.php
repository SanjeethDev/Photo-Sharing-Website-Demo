<!DOCTYPE html>
<html>
  <head>
    <title>Momento</title>
    <link rel="stylesheet" type="text/css" href="/../../../styles.css">
  </head>
  <body class="cs_body">
    <div class="home_title">
      <table style="width:100%; height: 10%;">
        <tr style="background-color: rgba(0, 0, 0, 0.5);">
          <td style="width: 50%; padding-top: 25px; padding-left: 25px;"><h1 class="cs_text" style="letter-spacing: 15px; line-height: 0; font-size: 40px; font-weight: 900;">Momento</h1></td>
        </tr>
      </table>
    </div>
    <hr>
    <center>
    <div style="padding: 25px;">
      <table class="cs_text" style="background-color: rgba(0, 0, 0, 0.7); padding: 25px; border-radius: 25px;">
        <?php
          $sql = new mysqli('localhost:3307','root','');
          if ($result = $sql -> query("SHOW DATABASES")) {
            $rows = $result -> fetch_all(MYSQLI_ASSOC);

            foreach ($rows as $row)
            {
              $name = $row['Database'];
              if ($name == "aperture") {
                $td = "td class='sp_borders'";
                $tr = "tr class='sp_borders'";
                $sql -> query("USE aperture");
                $result = $sql -> query("SELECT * FROM contact ORDER BY datetime DESC");
                $rows = $result -> fetch_all(MYSQLI_ASSOC);
                $count = $result -> num_rows;
                $slno = $count;
                echo "<$tr><$td>Sl.No.</$td><$td>First Name</$td><$td>Last Name</$td><$td>Email</$td><$td>Subject</$td><$td>Message</$td><$td>DateTime</$td></$tr>";
                foreach ($rows as $row)
                {

                  $firstname = $row['firstname'];
                  $lastname = $row['lastname'];
                  $email = $row['email'];
                  $subject = $row['subject'];
                  $message = $row['message'];
                  $datetime = $row['datetime'];
                  echo "<$tr><$td>$slno</$td><$td>$firstname</$td><$td>$lastname</$td><$td>$email</$td><$td>$subject</$td><$td>$message</$td><$td>$datetime</$td></$tr>";
                  $slno -= 1;
                }
              } else {
                $sql -> query("CREATE DATABASE aperture");
                $sql -> query("CREATE TABLE `aperture`.`contact` ( `firstname` VARCHAR(41) NOT NULL , `lastname` VARCHAR(41) NULL DEFAULT NULL , `email` VARCHAR(100) NOT NULL , `subject` VARCHAR(250) NULL DEFAULT NULL , `message` VARCHAR(1000) NOT NULL , `datetime` DATE NOT NULL ) ENGINE = InnoDB;");
              }

            }
            $result -> free_result();
          }
          $sql -> close();
        ?>
      </table>
   </div>
 </center>
  </body>
  <footer class="footer">
    &#9400; 2021 Momento.  All rights reserved.
    <br>
    <a href=""><img src="Resources/Image_Resources/instagram_icon.png" width="2%" style="padding-top: 10px;"></a>
    <a href=""><img src="Resources/Image_Resources/facebook_icon.png" width="2%" style="padding-top: 10px;"></a>
    <a href=""><img src="Resources/Image_Resources/twitter_icon.png" width="2%" style="padding-top: 10px;"></a>
  </footer>
</html>
