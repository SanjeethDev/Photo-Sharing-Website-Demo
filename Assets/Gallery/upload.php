<?php
// Variables & Assignments
session_start();
$fullnameofFile = strtolower(str_replace(array(' ',"(",")","-"), '', basename($_FILES['imgUpload']['name'])));
$typeofFile = strtolower(str_replace('image/','',$_FILES['imgUpload']['type']));
$typeofFile = 'jpeg' ? 'jpg' : 'jpg';
$nameofFile = str_replace(".".$typeofFile, '', $fullnameofFile);
$tmpnameofFile = $_FILES['imgUpload']['tmp_name'];
$errorinFile = $_FILES['imgUpload']['error'];
$sizeofFile = $_FILES['imgUpload']['size']/1000000;
$caption = $_POST['caption'];
$author = $_SESSION['User'];
$extensions = array("jpg","png");
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d h:i:s");

// Resizer function
function resizer ($source, $destination, $size, $quality=null) {
  $ext = strtolower(pathinfo($source)['extension']);
  $dimensions = getimagesize($source);
  $width = $dimensions[0];
  $height = $dimensions[1];

  if (is_array($size)) {
    $new_width = $size[0];
    $new_height = $size[1];
  } else {
    $new_width = ceil(($size/100) * $width);
    $new_height = ceil(($size/100) * $height);
  }

  $fnCreate = "imagecreatefrom" . ($ext=="jpg" ? "jpeg" : $ext);
  $fnOutput = "image" . ($ext=="jpg" ? "jpeg" : $ext);
  $original = $fnCreate($source);
  $resized = imagecreatetruecolor($new_width, $new_height);

  if ($ext=="png" || $ext=="gif") {
    imagealphablending($resized, false);
    imagesavealpha($resized, true);
    imagefilledrectangle(
      $resized, 0, 0, $new_width, $new_height,
      imagecolorallocatealpha($resized, 255, 255, 255, 127)
    );
  }

  imagecopyresampled(
    $resized, $original, 0, 0, 0, 0,
    $new_width, $new_height, $width, $height
  );
  if (is_numeric($quality)) {
    $fnOutput($resized, $destination, $quality);
  } else {
    $fnOutput($resized, $destination);
  }
  imagedestroy($original);
  imagedestroy($resized);
}

// File Checks
if (in_array($typeofFile,$extensions)) {
  if ($errorinFile == 0) {
    $uniqueid = str_replace(".","",uniqid(date("YmdHis"), true));
    $finalnameofFile = $nameofFile . "." . $uniqueid;
    $thumbnameofFile = $finalnameofFile . "-thumbnail." . $typeofFile;
    $finalnameofFile = $finalnameofFile . "." . $typeofFile;
    $target_image = "../Gallery/" . $finalnameofFile;

    $sql = new mysqli('localhost:3307','root','','aperture');
    $sql -> query("INSERT INTO gallery VALUES('$uniqueid','$finalnameofFile','$thumbnameofFile','$caption','$author','$date')");

    $sql -> close();

    if (move_uploaded_file($tmpnameofFile, $target_image)) {
        echo "The file ". htmlspecialchars($finalnameofFile). " has been uploaded.";
        $target_thumbnail = "thumbnails/".$thumbnameofFile;
        function reducepixels($inWidth,$inHeight) {
          for ($i=100; $i > 0; $i--) {
            if (($inWidth*$i)/100 <= 1080) {
              $outWidth = ($inWidth*$i)/100;
              $outHeight = ($inHeight*$i)/100;
              return array($outWidth,$outHeight);
              $i = 0;
            }
          }
        }
        $width = getimagesize($target_image)[0];
        $height = getimagesize($target_image)[1];
        list($fWidth,$fHeight) = reducepixels($width,$height);
        resizer($target_image, $target_thumbnail, [$fWidth,$fHeight]);
        header('Location: /Assets/Pages/Gallery.php');
      } else {
        echo "Sorry, there was an error uploading your file.";
      }

  } else {
    echo "Oops! Something went wrong. :/";
  }
} else {
  echo "Only jpg and png type allowed.";
}

?>
