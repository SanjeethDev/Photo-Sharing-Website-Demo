<?php
  session_start();
  if ($_POST['action'] == 'Logout') {
    session_destroy();
  }
?>
