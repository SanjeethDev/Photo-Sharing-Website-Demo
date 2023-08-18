<?php
  function check($input)
  {
    $sql = new mysqli('localhost:3307','root','','aperture');
    $userFlag = 1;
    $result = $sql -> query("SELECT EXISTS(SELECT * FROM user_accounts WHERE $input)");
    $rows = $result -> fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $key => $value) {
      foreach ($value as $rec) {
        $userFlag = $rec;
      }
    }
    $result -> free_result();
    $sql -> close();
    return $userFlag;
  }
  if (isset($_POST['checkInput'])) {
    echo check($_POST['checkInput']);
    unset($_POST['checkInput']);
  }
?>
