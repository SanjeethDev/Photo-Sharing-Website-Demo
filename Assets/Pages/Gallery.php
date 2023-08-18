<!DOCTYPE html>
<html>
  <span id="currentPgId" hidden>Gallery</span>
  <head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <link rel="p" href="/css/master.css">
    <script type="text/javascript" src="/navActive.js"></script>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."header.php") ?>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."favicon.php") ?>
    <?php echo "<span id='delMsgBox_container'></span>"; ?>
    <script>
      function upload_popup(flag) {
        if (flag == 0) {
          document.getElementById('body_id').style.maxWidth = "auto";
          document.getElementById('body_id').style.overflow = "auto";
          document.getElementById('upload_id').style.transform = "scale(0,0)";
          document.getElementById('upload_id').style.borderRadius = "100px";
        } else if (flag == 1) {
          document.getElementById('body_id').style.maxWidth = "100%";
          document.getElementById('body_id').style.overflow = "hidden";
          document.getElementById('upload_id').style.transform = "scale(1,1)";
          document.getElementById('upload_id').style.borderRadius = "0px";
        }
      }
      function readURL(input) {
        if (input.files && input.files[0]) {
          if (input.files[0].size/1048576 > 10) {
            document.getElementById('imgUploadMsg').innerHTML = "Image is too big! (" + (input.files[0].size/1048576).toFixed(2) + "MB)";
            document.getElementById('uploadbtn_id').style.backgroundImage = "url('/Assets/Image_Resources/header_backgroundOff.png')";
            document.getElementById('uploadbtn_id').disabled = true;

          } else {
            document.getElementById('imgUploadMsg').innerHTML = "";
            document.getElementById('uploadbtn_id').disabled = false;
            document.getElementById('uploadbtn_id').style.backgroundImage = "url('/Assets/Image_Resources/header_background.png')";
            var reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById('preview').src = e.target.result;
              var prevw = document.getElementById('preview');
              document.getElementById("preview").addEventListener("load", previewLoad);
              function previewLoad() {
                var prevImg = document.getElementById('preview');
                if(prevImg) {
                  var height = prevImg.height;
                  var width = prevImg.width;
                  if (height > width) {
                    document.getElementById('preview_div_id').style.visibility = "visible";
                    document.getElementById('preview_div_id').style.height = "250px";
                    document.getElementById('preview_div_id').style.width = "auto";

                  } else {
                    document.getElementById('preview_div_id').style.visibility = "visible";
                    document.getElementById('preview_div_id').style.width = "500px";
                    document.getElementById('preview_div_id').style.height = "auto";
                  }
                }
              }
            };
              reader.readAsDataURL(input.files[0]);
          }
        }
      }

      function delete_i() {
          $.ajax({
             type: 'POST',
             url: '/Assets/Pages/deleteImg.php',
             data:{action:'deleteImg_call',delImg:src}
           });
           document.getElementById('delMsgBox_container').innerHTML = "<div id='delMsg_id'>Post removed.</div>"
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
        console.log(fnattr);
        if (flag == 0) {
          //cancel
          body.style.maxWidth = "auto%";
          body.style.overflow = "auto";
          deletebox.style.transform = "scale(0,0)";
          console.log("2:"+flag+"|"+src);
        } else if (flag == 1) {
          //show
          body.style.maxWidth = "100%";
          body.style.overflow = "hidden";
          deletebox.style.transform = "scale(1,1)";
          console.log("1:"+flag+"|"+src);
        }
      }
    </script>
  </head>
  <body id="body_id" style="max-width: auto; overflow: auto;" onload="navActive()">

    <?php
      if(isset($_SESSION['User'])) {
        echo "
        <div style='padding: 15px 0px 0px 0px; display:flex; justify-content: center;'>
          <button type='button' name='upload' onclick='upload_popup(1)'>Upload</button>
        </div>";
      }
    ?>
    <div class="gallery_container" id="gallerydivid">
      <?php
        $sql = new mysqli('localhost:3307','root','','aperture');
        // Clean up Directories
        $files = scandir('../Gallery/');
        foreach ($files as $name) {
          if (!in_array($name, array('.','..','upload.php','thumbnails'))) {
            $result = $sql -> query("SELECT glimgname FROM gallery WHERE glimgname='$name'");
            $rowCount = $result -> num_rows;
            if($rowCount==0) {
              $deldir = '../Gallery/'.$name;
              unlink($deldir);
            }
          }
        }

        $files = scandir('../Gallery/thumbnails/');
        foreach ($files as $name) {
          if (!in_array($name, array('.','..'))) {
            $result = $sql -> query("SELECT gthumbnailname FROM gallery WHERE gthumbnailname='$name'");
            $rowCount = $result -> num_rows;
            if($rowCount==0) {
              $deldir = '../Gallery/thumbnails/'.$name;
              unlink($deldir);
            }
          }
        }


        // Empty
        $result = $sql -> query("SELECT gthumbnailname,glimgcaption,glimgauthor FROM gallery ORDER BY guploadtime");
        $rowCount = $result -> num_rows;
        if($rowCount==0) {
          print_r("Empty :/");
        } else {
          // Get Images from gallery
          $dir = "../Gallery/thumbnails/";
          $result = $sql -> query("SELECT gthumbnailname,glimgcaption,glimgauthor FROM gallery ORDER BY guploadtime DESC");
          $files = $result -> fetch_all(MYSQLI_ASSOC);
          foreach ($files as $img)
          {
            $src = $dir.$img['gthumbnailname'];
            $caption = $img['glimgcaption'];
            $author = $img['glimgauthor'];
            $button = "";
            if (isset($_SESSION['User'])) {
              if ($_SESSION['User']==$author) {
                $button = "<button
                  style = 'background: rgba(0, 0, 0, 0.5); border-radius: 10px; padding:5px 10px 5px 10px; margin-top:-20px;'
                  onclick = 'deletethis(1,this.parentNode.previousSibling.src)'>Delete</button>";
              } else {
                $button = "";
              }
            }
            echo "<div class='gallery_boxes'>";
            echo "<img src='$src' class='gallery_images'>";
            echo "<span style='padding: 5px 5px 5px 10px'><p style='font-weight: bolder; 'font-style: oblique;'>$author </p><p>$caption</p>$button</span>";

            echo "</div>";
          }
        }
        $result -> free_result();
        $sql -> close();
       ?>
    </div>
    <div id="upload_id" class="uploadbox">
      <center>
      <form action="/Assets/Gallery/upload.php" method="post" enctype="multipart/form-data" style="margin-top: 100px;">
        Select image to upload:
        <table>
          <tr>
            <td>
              <input type="file" name="imgUpload" id="imgUpload" class="imgUpload" onchange="readURL(this);">
              <h6 style="padding: 5px 0px 0px 20px; margin: 0px;">Max size is 10MB</h6>
            </td>
          <tr>
            <td>
              <center><p id="imgUploadMsg" style="padding: 5px 0px 0px 20px; margin: 0px;"></p></center>
            </td>
          </tr>
          </tr>
          <tr>
            <td>
              <textarea id="messageid" name="caption" cols="50" rows="5" placeholder="Caption" style="resize: none; padding-top: 15px;padding-bottom: 15px;" maxlength="500"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <button id="uploadbtn_id"type="submit" value="set" name="submit">Upload</button>
              <button id="close_id" type="button" name="close_upldbx" onclick="upload_popup(0);" >Close</button>
            </td>
          </tr>
        </table>

      </form>
      <div class="preview_div" id="preview_div_id">
          <img id="preview" src="" />
      </div>
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
  </body>
</html>
