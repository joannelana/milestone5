<?php
/* Insert User Info */
if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn = connDB();
$driverID = $_SESSION['id'];

$OfferHistory = $conn->query("Select * from DriverOffers WHERE DriverID='$driverID' ORDER BY DriverEventID DESC");

if (!$OfferHistory)
{
	echo "<h3>You do not have any offers with empty seats available.</h3>";
} else { 
	if (mysqli_num_rows($OfferHistory) > 0)
	{
		echo "<div class='table_admin' class='span7'>
				<h3>Your offers with empty seats left</h3>
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
					<th>No. of Confirmed Riders</th>
					<th>Price Per Ride</th>
					<th>Delete Offer</th>
				  </tr>";
	  
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($OfferHistory))
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
				echo'<td data-th="No. of Confirmed Riders">'. $row['NoOfConfirmedRiders'].'</td>';
				echo'<td data-th="Price Per Ride">$'. $row['PricePerRide'].'</td>';
				echo'<td data-th="Delete Offer"><button class="delete" onclick="deleteOffer_Driver('
				.$row['DriverEventID'].')">Delete</button></td>';
				echo "</tr>";
			}
		
		  }
			echo "</tbody></table></div>";
			echo "<div>No. of results: ".$count."</div>";
	} else {
	
		echo "<h3>You do not have any offers with empty seats available.</h3>";
	}
}
$conn->close();
?>