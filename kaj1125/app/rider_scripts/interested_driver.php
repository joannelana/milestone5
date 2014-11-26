<?php

if (!isset($_SESSION)) 
{
	session_start();
}

// for riders
if (isset($_SESSION['type']) == 2 || isset($_SESSION['type']) == 3) 
{ 
	include("../function.php");
	$conn = connDB();

	$RiderID = $_SESSION['id'];
	$sql = "Select * from PendingRides WHERE RiderID='$RiderID' AND WhoRequestThis=1";
	$InterestedDrivers = $conn->query($sql); // 2 means rider is interested. 1 means driver is interested.

	$RiderEventID = array();
	$DriverEventID = array();

	if($InterestedDrivers === FALSE) {
		echo '<h3>No interested riders sigh</h3>';
	} else  {

		$counter = 0;
		if (mysqli_num_rows($InterestedDrivers) > 0)
		{
			while ($row = mysqli_fetch_assoc($InterestedDrivers))
			{
				array_push($RiderEventID,$row['RiderEventID']);
				array_push($DriverEventID,$row['DriverEventID']);
				$counter++;
			}
		
		$conn->close();

		$conn = connDB();

		$index = 0;
		
		echo "<div id='table_admin' class='span7'>
				<h3>Interested Drivers (Unconfirmed Offers)</h3>
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
					<th>Confirm</th>
				  </tr>";
			foreach ($DriverEventID as $val)
			{
				$REID = $val;
				$GetDriverEvents = $conn->query("Select * from DriverOffers WHERE DriverEventID='$REID'");
	
				if (mysqli_num_rows($GetDriverEvents) > 0)
				{
					  $count =  0;
					  while ($row = mysqli_fetch_assoc($GetDriverEvents))
					  {
						$EtId = $RiderEventID[$index];
						$count++;
						echo "<tr>";
						echo'<td data-th="No.">'. $count.'</td>';
						echo'<td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
						echo'<td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
						echo'<td data-th="Destination">'. $row['Destination'].'</td>';
						echo'<td data-th="Pickup Time Range (Start)">'. $row['PickupStartTimeRange'].'</td>';
						echo'<td data-th="Pickup Time Range (End)">'. $row['PickupEndTimeRange'].'</td>';
						echo'<td data-th="Date">'. $row['Date'].'</td>';
						$spaceLeft = $row['MaxNum'] - $row['NoOfConfirmedRiders'];
						echo'<td data-th="Max Allowed">'. $row['MaxNum'].'</td>';
						echo'<td data-th="Space Left">'. $spaceLeft.'</td>';
						echo'<td data-th="Price Per Ride">$'. $row['PricePerRide'].'</td>';
						echo'<td data-th="Request Ride"><button class="join" onclick="confirm('
						.$row['DriverEventID'].','.$row['DriverID'].','.$EtId.','.$RiderID.')">Confirm</button></td>';
						echo "</tr>";
		
					  }
				} 
				$index++;
			}
		
			echo "</tbody></table></div>";
			echo "<div>No. of results: ".$index."</div>";
		} else {
			echo "<h3>No interested drivers (Unconfirmed Offers).</h3>";
		}
	}

} else {
	echo "Why am I here?";
}
$conn->close();	
?>