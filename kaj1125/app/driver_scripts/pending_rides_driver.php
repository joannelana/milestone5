<?php

if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn=connDB();

$DriverID = $_SESSION['id'];

$results = $conn->query("Select * from PendingRides WHERE DriverID='$DriverID' AND WhoRequestThis=1");

if($results){ // there are results. Select returns object. Other common queries return true.
	if (mysqli_num_rows($results) > 0)
	{
		echo "<div id='table_admin' class='span7'>
				<h3>Pending Sent Invitations</h3>
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
	  	  
		  while ($row = mysqli_fetch_assoc($results))
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
				echo'<td data-th="Request Ride"><button class="join" onclick="deleteOffer('
				.$row['DriverEventID'].')">Delete</button></td>';
				echo "</tr>";
		  }
		  
		  echo "</tbody></table></div>";
		  echo "<div>No. of results: ".$count."</div>";
	} else {
		echo "<h3>No Pending Sent Invitations</h3>";
	}
} else {
	echo "<h3>No Pending Sent Invitations</h3>";
}
$conn->close();

?>