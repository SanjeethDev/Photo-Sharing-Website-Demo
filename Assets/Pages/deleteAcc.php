<?php

  if($_POST['action'] == 'deleteAcc_call') {
    $AccUsername = $_POST['delAcc'];
    $sql = new mysqli('localhost:3307','root','','aperture');
    $sql -> query("DELETE FROM user_accounts WHERE username='$AccUsername'");
    $sql -> query("DELETE FROM gallery WHERE glimgauthor='$AccUsername'");
    $sql -> close();
    session_start();
    session_destroy();
  }

?>
