<?php
  if($_POST['action'] == 'delete_call') {
    $email = $_POST['delEmail'];
    $datetime = $_POST['delDatetime'];
    $sql = new mysqli('localhost:3307','root','','aperture');
    $sql -> query("DELETE FROM contact WHERE email='$email' AND datetime='$datetime'");
    echo 'WORKED';
    $sql -> close();
  }
?>
