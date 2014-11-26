<?php
	if ($_SESSION['type'] == 1) // driver
	{
		include "driver/driver_home.php";
	}
	else if($_SESSION['type'] == 2) //rider
	{
		include "rider/rider_home.php";
	}
?>