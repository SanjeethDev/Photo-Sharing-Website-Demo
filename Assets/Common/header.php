<?php
  session_start();
  if (isset($_SESSION['User'])) {
    $login = $_SESSION['User'];
    $email = $_SESSION['Email'];
    $href = "";
    if ($login == "admin") {
      $avatar = "
      <li class='nav_ul_li'>
        <a class='nav_ul_li_a avatar' href=''>
          <span class='avatar_name'>$login</span>
          <img class='avatar_icon' src='/Assets/Image_Resources/dropdown_icon.png' width='12px' height='12px'>
        </a>
        <ul class='nav_ul_li_ul'>
          <li class='nav_ul_li_ul_li'><a class='nav_ul_li_ul_li_a' href='/Assets/Pages/Profile.php'>Profile</a></li>
          <li class='nav_ul_li_ul_li'><a class='nav_ul_li_ul_li_a' href='/Assets/Pages/getdata.php'>Contacts</a></li>
          <li class='nav_ul_li_ul_li'><a class='nav_ul_li_ul_li_a' href='#' onclick='logOut();'>Log Out</a></li>
        </ul>
      </li>
      ";
    } else {
      $avatar = "
      <li class='nav_ul_li'>
        <a class='nav_ul_li_a avatar' href='#'>
          <span class='avatar_name'>$login</span>
          <img class='avatar_icon' src='/Assets/Image_Resources/dropdown_icon.png' width='12px' height='12px'>
        </a>
        <ul class='nav_ul_li_ul'>
          <li class='nav_ul_li_ul_li'><a class='nav_ul_li_ul_li_a' href='/Assets/Pages/Profile.php'>Profile</a></li>
          <li class='nav_ul_li_ul_li'><a class='nav_ul_li_ul_li_a' href='#' onclick='logOut();'>Log Out</a></li>
        </ul>
      </li>
      ";
    }
  } else {
    $login = "Login";
    $email = 'Email';
    $href = "/Assets/Pages/Login.php";
    $avatar = '
    <li id="login_id" class="nav_ul_li"><a class="nav_ul_li_a login_button" href="/Assets/Pages/Login.php">Login</a>
    </li>
    ';
  }
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>

<script type="text/javascript">
  function sendRequest() {
    return $.ajax(
      {
        type: "POST",
        url: '/Assets/Pages/logout.php',
        data:{action:'Logout',loc:$(location).attr('href')}
      }
    );
  }
  function logOut() {
    ah = sendRequest()
    if (ah) {
      setTimeout(function(){
          window.location='/Assets/Pages/Gallery.php';
        },1280)
    }

  }


</script>

<header>
  <nav class="nav">
    <p class="title"><a href="/Main.php">Aperture</a></p>
    <ul class="nav_ul">
        <!-- <li id="home_id" class="nav_ul_li"><a class="nav_ul_li_a" href="/Main.php">Home</a></li> -->
        <li id="gallery_id" class="nav_ul_li"><a class="nav_ul_li_a" href="/Assets/Pages/Gallery.php">Feed</a></li>
        <li id="contact_id" class="nav_ul_li"><a class="nav_ul_li_a" href="/Assets/Pages/Contact.php">Contact</a></li>
        <li id="about_id" class="nav_ul_li"><a class="nav_ul_li_a" href="/Assets/Pages/About.php">About</a></li>
        <?php echo $avatar; ?>
    </ul>
  </nav>
</header>
