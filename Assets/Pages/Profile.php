<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/../../styles.css">
    <script type="text/javascript" src="/navActive.js"></script>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."header.php") ?>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."favicon.php") ?>

  </head>
  <body onload="navActive()" id="body_id">
    <div class="profile_container">
      <?php
      if ($login == 'Login') {
        header("location: /Assets/Pages/Login.php");
      } else {
        echo
        "<div class='acc_details'><div class='pc_hds'>".
        "<h4 id='userNameP_id'>"
        .$login.
        "</h4><h6>"
        .$email.
        "</h6><button
          style = 'background: rgba(0, 0, 0, 0.5); border-radius: 10px; padding:0.5vw 1vw 0.5vw 1vw; float: right; margin-right: 10vw;'
          onclick = 'deletethisacc(1)'>Delete Account</button>

        </div></div>";

        $sql = new mysqli('localhost:3307','root','','aperture');
        $result = $sql -> query("SELECT gthumbnailname,glimgcaption,glimgauthor FROM gallery ORDER BY guploadtime");
        $rowCount = $result -> num_rows;
        if($rowCount==0) {
          print_r("Empty :/");
        } else {
          // Get Images from gallery
          $dir = "../Gallery/thumbnails/";
          $result = $sql -> query("SELECT gthumbnailname,glimgcaption,glimgauthor FROM gallery ORDER BY guploadtime DESC");
          $files = $result -> fetch_all(MYSQLI_ASSOC);
          echo "<center><br><hr style='width: 80%;'>";
          echo "<br>Posts:</center>";
          echo '<div class="profile_posts_container">';
          foreach ($files as $img)
          {
            $src = $dir.$img['gthumbnailname'];
            $caption = $img['glimgcaption'];
            $author = $img['glimgauthor'];
            $button = "";
            if (isset($_SESSION['User'])) {
              if ($_SESSION['User']==$author) {
                $button = "<button
                  style = 'background: rgba(0, 0, 0, 0.5); border-radius: 10px; padding:5px 10px 5px 10px; margin-right:0; float:right;'
                  onclick = 'deletethis(1,this.parentNode.previousSibling.src)'>Delete</button>";
                echo "<div class='profile_posts'>" ;
                echo "<img src='$src'>";
                echo "<span style='padding: 5px 5px 5px 10px'><p style='font-weight: bolder; 'font-style: oblique;'>$author </p><p>$caption</p>$button</span>";
                echo "</div>";
              }
            }
          }
          echo '</div>';
        }
        $result -> free_result();
        $sql -> close();
      }

      ?>
    </div>
    <div id="deleteboxa_id" class="deletebox">
      <center>
        <table class="deleteinsidebox">
          <tr>
            <td id="areyousurea_id" >Are you sure you want to delete account?</td>
          </tr>
          <tr>
            <td id="areyousurenamea_id" ></td>
          </tr>
          <tr style="text-align:right">
            <td><button id="delimgcona_id" type="button" name="button" onclick="delete_acc();">Delete</button></td>
            <td><button type="button" name="button" onclick="deletethisacc(0);">Cancel</button></td>
          </tr>
        </table>
    </center>
    </div>
    <div id="deletebox_id" class="deletebox">
      <center>
        <table class="deleteinsidebox">
          <tr>
            <td id="areyousure_id" >Are you sure you want to delete?</td>
          </tr>
          <tr>
            <td id="areyousurename_id" ></td>
          </tr>
          <tr style="text-align:right">
            <td><button id="delimgcon_id" type="button" name="button" onclick="delete_i();">Delete</button></td>
            <td><button type="button" name="button" onclick="deletethis(0);">Cancel</button></td>
          </tr>
        </table>
      </center>
    </div>
    <script type="text/javascript">
      function delete_acc() {
          $.ajax({
             type: 'POST',
             url: '/Assets/Pages/deleteAcc.php',
             data:{action:'deleteAcc_call',delAcc:acc}
           });
           setTimeout(function(){
             location.reload();
           },1280)
        }
      var acc = document.getElementById('userNameP_id').innerHTML;
      function deletethisacc(flag) {
        var deletebox = document.getElementById('deleteboxa_id');
        var body = document.getElementById('body_id');
        var deletebutton = document.getElementById('delimgcona_id');
        if (flag == 0) {
          //cancel
          body.style.maxWidth = "auto%";
          body.style.overflow = "auto";
          deletebox.style.transform = "scale(0,0)";
          console.log("2:"+flag+"|"+acc);
        } else if (flag == 1) {
          //show
          body.style.maxWidth = "100%";
          body.style.overflow = "hidden";
          deletebox.style.transform = "scale(1,1)";
          console.log("1:"+flag+"|"+acc);
        }
      }

      function delete_i() {
          $.ajax({
             type: 'POST',
             url: '/Assets/Pages/deleteImg.php',
             data:{action:'deleteImg_call',delImg:src}
           });
           setTimeout(function(){
             location.reload();
           },1280)
        }
      var src;
      function deletethis(flag,srck) {
        window.src = srck;
        var deletebox = document.getElementById('deletebox_id');
        var body = document.getElementById('body_id');
        var deletebutton = document.getElementById('delimgcon_id');
        var fnattr = "delete_i(" + src + ")";

        if (flag == 0) {
          //cancel
          body.style.maxWidth = "auto%";
          body.style.overflow = "auto";
          deletebox.style.transform = "scale(0,0)";
        } else if (flag == 1) {
          //show
          body.style.maxWidth = "100%";
          body.style.overflow = "hidden";
          deletebox.style.transform = "scale(1,1)";
        }
      }
    </script>
  </body>
</html>
