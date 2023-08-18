<?php

  if($_POST['action'] == 'deleteImg_call') {
    $imgthumbnailSrc = $_POST['delImg'];
    $imgthumbnailName =  substr($imgthumbnailSrc, strpos($imgthumbnailSrc, "thumbnails/") + strlen("thumbnails/"));
    file_put_contents("logs.txt","\n\Trim: $str\n",FILE_APPEND);
    $imgfileName = str_replace('-thumbnail','',$imgthumbnailName);
    $root = $_SERVER['DOCUMENT_ROOT'];
    $imgLoc = 'Assets/Gallery/';
    $target_dFile = $root.$imgLoc.$imgfileName;
    $target_dThumbnail = $root.$imgLoc."thumbnails/".$imgthumbnailName;
    file_put_contents("logs.txt","$target_dFile\n$target_dThumbnail",FILE_APPEND);
    unlink($target_dFile);
    unlink($target_dThumbnail);
    $sql = new mysqli('localhost:3307','root','','aperture');
    $sql -> query("DELETE FROM gallery WHERE gthumbnailname='$imgthumbnailName'");
    $sql -> close();
  }

?>
