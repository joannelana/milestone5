<?php

if (!isset($_SESSION)) 
{
	session_start();
}

$EtId = microtime(true); //Generate Event Id Using Unix Time
$locFrom = $_POST['locFrom'];
$locTo = $_POST['locTo'];
$timeFrom = $_POST['timeFrom'];
$timeTo = $_POST['timeTo'];
$date = $_POST['date'];
$sort = $_POST['sort'];
$riderId = $_SESSION['id'];
$familyname = $_SESSION['familyname'];
$givenname = $_SESSION['givenname'];

include("../function.php");

$conn = connDB();
$sql = "Insert into RiderRequest VALUES('$locFrom','$locTo',
		'$timeFrom','$timeTo','$EtId','$riderId','$date',0,'$familyname','$givenname')";
if ($conn->query($sql))
{
	$conn->close();
	
	$conn = connDB();

	$riderRequestedEvents = $conn->query("Select * from DriverOffers 
	WHERE PickupPlace='$locFrom' AND Date='$date' AND Destination='$locTo'");

	$match = array();

	if (mysqli_num_rows($riderRequestedEvents) > 0)
	{
		echo "<div id='table_admin' class='span7'>
				<h3>Search Results: Matched Rides from Drivers</h3>
				<table class='rwd-table'>
				  <tbody>
				  <tr>
				  	<th>No.</th>
					<th>Name</th>
					<th>Pick-Up Place</th>
					<th>Destination</th>
					<th>Pickup Time Range (Start)</th>
					<th>Pickup Time Range (End)</th>
					<th>Date</th>
					<th>Max Allowed</th>
					<th>Space Left</th>
					<th>Price Per Ride</th>
					<th>Request Ride</th>
				  </tr>";
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($riderRequestedEvents))
		  {
		  	$spaceLeft = $row['MaxNum'] - $row['NoOfConfirmedRiders'];
		  	if ($spaceLeft > 0)
		  	{
				$count++;
				echo "<tr>";
				echo'<td data-th="No.">'. $count.'</td>';
				echo'<td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
				echo'<td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
				echo'<td data-th="Destination">'. $row['Destination'].'</td>';
				echo'<td data-th="Pickup Time Range (Start)">'. $row['PickupStartTimeRange'].'</td>';
				echo'<td data-th="Pickup Time Range (End)">'. $row['PickupEndTimeRange'].'</td>';
				echo'<td data-th="Date">'. $row['Date'].'</td>';
				echo'<td data-th="Max Allowed">'. $row['MaxNum'].'</td>';
				echo'<td data-th="Space Left">'. $spaceLeft.'</td>';
				echo'<td data-th="Price Per Ride">$'. $row['PricePerRide'].'</td>';
				echo'<td data-th="Request Ride"><button class="join" onclick="sendRequest_Rider('
				.$row['DriverEventID'].','.$row['DriverID'].','.$EtId.','.$riderId.')">Request</button></td>';
				echo "</tr>";
	  	  	}
		  }
		  
		  echo "</tbody></table></div>";
		  echo "<div>No. of results: ".$count."</div>";

	} else {
		echo "<h3>No search results available. Better luck next time!=P</h3>";
	}
	
}
else
{
	echo "<h3>No search results available. Better luck next time!=P</h3>";
}	
$conn->close();
?>

