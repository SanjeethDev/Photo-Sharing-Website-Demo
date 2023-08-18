<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
<script type="text/javascript">
  function checkValidUN() {
    var inputE = document.getElementById('userName_id').value;
    inputE = inputE.toLowerCase();
    if (inputE == "") {
      document.getElementById('demo2').innerHTML = '';
    } else {
      $.ajax({
        type: "POST",
        url: "/Project/Assets/Pages/checkinDB.php",
        data:{checkInput: "username='" + inputE + "'"},
        success: function(response) {
          if (response == 1) {
            document.getElementById('demo1').innerHTML = 'Username not available.';
          } else {
            document.getElementById('demo1').innerHTML = '<img src="/Assets/Image_Resources/correct.png" width="16px" height="16px">';
          }
        }
      });
    }
  }

  function checkValidEM() {
    var inputE = document.getElementById('userEmail_id').value;
    inputE = inputE.toLowerCase();
    if (inputE.includes("@gmail.com")) {
      $.ajax({
        type: "POST",
        url: "/Project/Assets/Pages/checkinDB.php",
        data:{checkInput: "email='" + inputE + "'"},
        success: function(response) {
          if (response == 1) {
            document.getElementById('demo2').innerHTML = 'Account already exists.';
          } else {
            document.getElementById('demo2').innerHTML = '<img src="/Assets/Image_Resources/correct.png" width="16px" height="16px">';
          }
        }
      });
    } else if (inputE == "") {
      document.getElementById('demo2').innerHTML = '';
    } else {
      document.getElementById('demo2').innerHTML = '<img src="/Assets/Image_Resources/wrong.png" width="16px" height="16px">';
    }
  }
</script>

<label for="userName">Enter Username</label>
<input id="userName_id" type="text" name="userName" oninput="checkValidUN();" required>
<div id="demo1"></div>
<br><br>
<label for="userEmail">Enter Email</label>
<input id="userEmail_id" type="email" name="userEmail" oninput="checkValidEM();" onblur="document.getElementById('demo2').innerHTML = '';" required>
<div id="demo2"></div>
