<?php
if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn=connDB();

$DriverID = $_SESSION['id'];

$sql = "SELECT * FROM ConfirmedRides LEFT JOIN RiderRequest ON ".
		"RiderRequest.RiderEventID = ConfirmedRides.RiderEventID".
		" WHERE ConfirmedRides.DriverID='$DriverID'";
		

$results = $conn->query($sql);

if($results)
{
	if (mysqli_num_rows($results) > 0)
	{
		echo "<div id='table_admin' class='span7'>
				<h3>Confirmed Rides from Riders</h3>
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
				  </tr>";
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($results))
		  {
		  		if ($row['PickupPlace'] === NULL)
		  		{
		  			continue;
		  		
		  		} else {
					$count++;
					echo'<tr>';
					echo'<td data-th="No.">'. $count .'</td>';
					echo'<td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
					echo'<td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
					echo'<td data-th="Destination">'. $row['Destination'].'</td>';
					echo'<td data-th="Pickup Time Range (Start)">'. $row['StartTimeRange'].'</td>';
					echo'<td data-th="Pickup Time Range (End)">'. $row['EndTimeRange'].'</td>';
					echo'<td data-th="Date">'. $row['Date'].'</td>';
					echo'</tr>';
				}
		  }
		  
		  echo "</tbody></table></div>";
		  echo "<div>No. of results: ".$count."</div>";
	} else {
		echo "<h3>No confirmed Rides</h3>";
	}
} else {
	echo "Error updating record in DriverOffer in confirm.php: " . $conn->error;
}

$conn->close();
?>