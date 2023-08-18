<!DOCTYPE html>
<html>
  <body onload=" document.createElement('form').submit.call(document.getElementById('autoform_id'))">
    <?php
    if (isset($_POST['login'])) {
      $username = $_POST['userName'];
      $password = $_POST['userPassword'];
      $message = "Invalid Username or Password.";
      $sql = new mysqli('localhost:3307','root','','aperture');
      $result = $sql -> query("SELECT * FROM user_accounts WHERE username='$username' AND password='$password'");
      $count = $result -> num_rows;
      if ($count == 1) {
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        session_start();
        $_SESSION['User'] = $username;
        $_SESSION['Email'] = $rows[0]['email'];
        header("location: /Assets/Pages/Gallery.php");
      } else {
        echo "
        <form id='autoform_id' method='post' action='Login.php'>
          <input type='hidden' name='username' value='$username'>
          <input type='hidden' name='password' value='$password'>
          <input type='hidden' name='message' value='$message'>
          <input type='hidden' name='submit' id='submit value='Continue'/>
        </form>
        ";
      }
      $result -> free_result();
      $sql -> close();
    }
    ?>
  </body>
</html>
