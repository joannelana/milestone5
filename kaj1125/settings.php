<?php
	if (session_status() == PHP_SESSION_NONE)
	{
    	session_start();
	}
?>

<!doctype html>
<html>
<head>
<?php require "static/module/_includes.php"; ?>
</head>
<body>

<?php
	include "static/module/_header.php";
	if(isset($_SESSION['email'])){
		include "app/setting_page.php";
	}
	else{
		include "static/module/_home_pre.php";
	}
	include "static/module/_footer.php";

?>
</body>
</html>