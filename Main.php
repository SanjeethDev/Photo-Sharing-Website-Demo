<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="/Project/navActive.js"></script>
    <?php $PATH = $_SERVER["DOCUMENT_ROOT"]."/Assets/Common/"; include($PATH."favicon.php") ?>

  </head>
  <body onload="navActive()" style="overflow: hidden;">
    <?php //$PATH = $_SERVER["DOCUMENT_ROOT"]."/Project/Assets/Common/"; include($PATH."header.php") ?>
    <div class="startpage_container">
      <div class="maintitles_container" id="maintitles_container_id">
        <div class="title_container">
          <p class="title titlex">Aperture</p>
          <p class="title subtitle">Capture your moments</p>
          <button class="explore_button" type="button" name="explore" onclick="window.location='/Assets/Pages/Gallery.php';">Explore</button>
        </div>
      </div>
    </div>
  </body>
</html>
