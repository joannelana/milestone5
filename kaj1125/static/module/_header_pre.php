<div class="header">
<div class = "fixed-width-centered">
  <form action = 'app/login.php' method = 'POST' name='logInTo'>
    <div class = "logo">
    <a href="http://fontmeme.com/cursive-fonts/"><img src="http://fontmeme.com/newcreate.php?text=Wheels%20Sharing&name=Pacifico.ttf&size=36&style_color=A61024" alt="Cursive Fonts"></a><p style="padding-left: 15px; font-size: 10px;"></p>
      <!-- <a href="index.php"><img src="http://fontmeme.com/newcreate.php?text=Wheels%20Sharing&name=Redressed.ttf&size=50&style_color=1A1A6B" alt="Cursive Fonts"></a> -->
      <!-- <p style="padding-left: 15px; font-size: 10px;"> -->
    </div>
    <div class="login">
      <div class="input-group">
        <span class="input-group-addon-log"><i class="fa fa-envelope-o fa-fw"></i></span>
        <input class="form-control" type="text" name="email" placeholder="Email Address" size="13" maxlength="40" value="" />
      </div>
      <div class="input-group">
        <span class="input-group-addon-log"><i class="fa fa-key fa-fw"></i></span>
        <input class="form-control" type="password" placeholder="Password" name="password" size="13" maxlength="100" />
      </div>
      <a class="button" onclick="document.logInTo.submit()"><i class="fa fa-sign-in"></i> Log In &nbsp</a>
        <?php
          if (isset($_GET['err']) && $_GET['err'] == 1){
            echo '<label><span style="color: #a61024;">&nbsp;&nbsp;*Incorrect credentials</span></label>';
          }
        ?>
    </div>
    <div style ="clear: both;"></div>
  </form>
</div>
</div>

<!-- Function to Check Cookie -->
<script type="text/javascript">
  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
  }

  function checkCookie()
  {
    var email=decodeURIComponent(getCookie("email"));
    var password=decodeURIComponent(getCookie("password"));
    /* Cookie is set */
    if(email!="" && password!="")
    {
      document.forms["logInTo"].email.value = email;
      document.forms["logInTo"].password.value = password;
      document.forms["logInTo"].submit();
    }
  }
  checkCookie();
</script>


