<!-- Post_Header -->
<!-- 
Includes: 
Logo
Welcome Back + User Email
Logout
-->

<style type = "text/css">
	.login {
		float:left;
		width:45%;
		padding-top: 20px;
		margin-top:35px;
		}
	.login span {
		float: left;
		padding-top:5px;
		font-family: arial;
		color:#A61024;
		}
	.login a {
		color:#555;
	}
</style>
<div class="header">
	<div class = "fixed-width-centered">
		<div class = "logo">
    		<a href="http://fontmeme.com/cursive-fonts/"><img src="http://fontmeme.com/newcreate.php?text=Wheels%20Sharing&name=Pacifico.ttf&size=36&style_color=A61024" alt="Cursive Fonts"></a><p style="padding-left: 15px; font-size: 10px;"></p>
    	</div>
		<div class = "login">
			<span>Welcome back,&nbsp;<?php echo $_SESSION['email']; ?>!</span>
			<a class = "button" type="button" onClick="window.location='settings.php';"/><i class="fa fa-sign-in fa-fw"></i>&nbsp;Settings &nbsp;</a>
			<a class = "button" type="button" onClick="window.location='app/logout.php';"/><i class="fa fa-sign-in fa-fw"></i>&nbsp;Log Out &nbsp;</a>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>

