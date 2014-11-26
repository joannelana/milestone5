<style type="text/css">
.slogan {
  margin-top:-30px;
  margin-left:0%;
  height:500px;
  width:60%;
  float:left;
  background-image: url('static/img/homepage.jpg') !important; 
  background-size:100%;
  /*background-color:black;*/
}
.register{
  /*height:100%;*/
  display: inline-block;
  width:30%;
  float: left;
  color:#A61024;
  font-size:10px;
  font-family: arial;
  font-weight: bold;
  margin-top:80px;
  margin-left:10%;
  /*background-color:black;*/
  /*background: rgba(255, 255, 255, 0.5);*/
}
.sign_up_button {
    display: inline-block;
    position: relative;
    background: white;
    font: 15px Arial;
    color: black;
    padding: 0;
    float: left;
    text-align: center;
    border-radius: 3px;
    cursor: pointer;
    border: 1px solid #ccc;
    background: #eee;
    color: #555;
    /*margin-top:4px;*/
    width:250px;
    height:30px;
    margin-top:10px;
    margin-right:0px;
    font-weight:bold;
    /*padding: 3px 3px;
    margin: 15px 0px 0px 6px;*/
  }
  .type_ddl{
    display: inline-block;
    position: relative;
    background: white;
    font: 12px Arial;
    color: black;
    padding: 0;
    float: left;
    text-align: center;
    border-radius: 3px;
    cursor: pointer;
    border: 1px solid #ccc;
    background: #eee;
    color: #555;

    /*margin-top:4px;*/
    width:250px;
    height:20px;
    margin-top:5px;
    margin-left:7px;
    /*padding: 3px 3px;
    margin: 15px 0px 0px 6px;*/
  }
  .error_strings{
    width:230px;
    height:15px;
    position: relative;
    float: left;
    margin-left: 7px;
  }




</style>

<div class = "home">
<div class = "fixed-width-centered">
  <!-- <img src="static/img/car.jpg" width="800" height="480"> -->
  <div class = "slogan">
  &nbsp;
  <!-- College student? Looking for a ride? Or willing to offer a ride? Sign up and we will find you a match here.  -->
  <!-- <a href="http://fontmeme.com/cursive-fonts/"><img src="http://fontmeme.com/newcreate.php?text=Matching%20student%20drivers%20and%20passengers&name=NoLicense_KeraterMedium.ttf&size=24&style_color=03030F" alt="Cursive Fonts"></a><p style="padding-left: 15px; font-size: 10px;"></p> -->
  <!-- <a href="http://fontmeme.com/cursive-fonts/"><img src="http://fontmeme.com/newcreate.php?text=Matching%20student%20drivers%20and%20passengers&name=NoLicense_KeraterUltraLight.ttf&size=32&style_color=03030F" alt="Cursive Fonts"></a><p style="padding-left: 15px; font-size: 10px;">by <a href="http://fontmeme.com/cursive-fonts/">Font Meme</a></p> -->
  <!-- <a href="http://fontmeme.com/cursive-fonts/"><img src="http://fontmeme.com/newcreate.php?text=Matching%20student%20drivers%20and%20passengers&name=NoLicense_KeraterUltraLight.ttf&size=32&style_color=FAFAFA" alt="Cursive Fonts"></a><p style="padding-left: 15px; font-size: 10px;">by <a href="http://fontmeme.com/cursive-fonts/">Font Meme</a></p> -->
     <!--  <a href="http://fontmeme.com/cursive-fonts/">
      <img src="http://fontmeme.com/newcreate.php?text=A%20website%20to%20match%20drivers%20and%20riders.&name=NoLicense_KeraterMedium.ttf&size=24&style_color=131357" alt="Cursive Fonts"></a><p style="padding-left: 15px; font-size: 8px;">
      </p> -->
  </div>
  <div class="register">
    <form action="app/register.php" method = 'POST' name="myform">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
        <input class="form-control-signup" type="text" name="email" placeholder="*Email Address" size="13" maxlength="40" value="" />
      </div>
      <div id='myform_email_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
        <input class="form-control-signup" type="text" name="givenname" placeholder="*Given Name" size="13" maxlength="40" value="" />
      </div>
      <div id='myform_givenname_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
        <input class="form-control-signup" type="text" name="familyname" placeholder="*Family Name" size="13" maxlength="40" value="" />
      </div>
      <div id='myform_familyname_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
        <input class="form-control-signup" type="password" placeholder="*Password" name="password" size="13" maxlength="100" />
      </div>
      <div id='myform_password_errorloc' class="error_strings"></div>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
        <input class="form-control-signup" type="password" placeholder="*Confirm Password" name="re-password" size="13" maxlength="100" />
      </div>
      <div id='myform_re-password_errorloc' class="error_strings"></div>
      <select class = "type_ddl" name='type'><option value="1">Driver</option><option value="2">Rider</option></select>
      <div class="input-group">
        <input class = "sign_up_button" type = "submit" value = "Sign Up" />
      </div>
            <!-- <a class="button2 toolbar-button" onclick="document.signUpForm.submit()"><i class="fa fa-user"></i> Sign Up </a> -->
      <!-- <div><p>*Compulsory</p></div> -->
    
    </form>
  </div>
  <div style="clear: both;"></div>
</div>
</div>

<script language="JavaScript" type="text/javascript" xml:space="preserve">
    //You should create the validator only after the definition of the HTML form
    var frmvalidator  = new Validator("myform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("familyname","req","Required field");
    frmvalidator.addValidation("givenname","req","Required field");

    frmvalidator.addValidation("email","maxlen=50");
    frmvalidator.addValidation("email","req","Required field");
    frmvalidator.addValidation("email","email","Enter a valid email address");

    frmvalidator.addValidation("password","req","Required field");
    frmvalidator.addValidation("password","maxlen=50");
    frmvalidator.addValidation("re-password","req","Required field");

    frmvalidator.addValidation("re-password","eqelmnt=password",
    "The confirmed password does not match password");
</script>

<?php
// if (isset($_GET['success']) && ($_GET['success'] == 1))
// {
//   echo '<span style="color: green;">Account created successfully.</span><br/>';
// }
// else if (isset($_GET['err']) && $_GET['err'] == 2)
// {
//   echo '<span style="color: red;">Account creation failed.</span><br/>';
// }
// else if (isset($_GET['err']) && $_GET['err'] == 3)
// {
//   echo '<span style="color: red;">Email already exists. Sign up with a different email.</span><br/>';
// }
?>
</div>
