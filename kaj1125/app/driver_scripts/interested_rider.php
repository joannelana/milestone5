<?php

if (!isset($_SESSION)) 
{
	session_start();
}

// for drivers
if (isset($_SESSION['type']) == 1 || isset($_SESSION['type']) == 3) 
{
	include("../function.php");
	$conn = connDB();

	$DriverID = $_SESSION['id'];
	$InterestedRiders = $conn->query("Select * from PendingRides WHERE DriverID='$DriverID' AND WhoRequestThis=2"); // 2 means rider is interested. 1 means driver is interested.

	$RiderEventID = array();
	$DriverEventID = array();

	if(!$InterestedRiders) {
		echo '<h3>No interested riders sigh</h3>';
	} else  {


		if (mysqli_num_rows($InterestedRiders) > 0)
		{
			while ($row = mysqli_fetch_assoc($InterestedRiders))
			{
				array_push($RiderEventID,$row['RiderEventID']);
				array_push($DriverEventID,$row['DriverEventID']);
			}
		
			$conn->close();
		
			echo "<div class='table_admin' class='span7'>
							<h3>Interested Riders (Unconfirmed Offers)</h3>";
					echo "<table class='rwd-table'>
							  <tbody>
							  <tr>
								<th>No.</th>
								<th>Name</th>
								<th>Pick-Up Place</th>
								<th>Destination</th>
								<th>Pickup Time Range (Start)</th>
								<th>Pickup Time Range (End)</th>
								<th>Date</th>
								<th>Confirm</th>
							  </tr>";
			$index = 0;
			$conn = connDB();
			foreach ($RiderEventID as $val)
			{
	// 			$conn = connDB();
				$REID = $val;
				$GetRiderEvents = $conn->query("Select * from RiderRequest WHERE RiderEventID='$REID'");
	
				if (mysqli_num_rows($GetRiderEvents) > 0)
				{
					  $count =  0;
					  while ($row = mysqli_fetch_assoc($GetRiderEvents))
					  {
						$EtId = $DriverEventID[$index];
						$count++;
						$num = $index + 1;
						echo'<tr>';
						echo'<td data-th="No.">'. $num .'</td>';
						echo'<td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
						echo'<td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
						echo'<td data-th="Destination">'. $row['Destination'].'</td>';
						echo'<td data-th="Pickup Time Range (Start)">'. $row['StartTimeRange'].'</td>';
						echo'<td data-th="Pickup Time Range (End)">'. $row['EndTimeRange'].'</td>';
						echo'<td data-th="Date">'. $row['Date'].'</td>';
						echo'<td data-th="Invite"><button class="join" onclick="confirm('
						.$EtId.','.$DriverID.','.$row['RiderEventID'].','.$row['RiderID'].')">Confirm</button></td>';
						echo'</tr>';
		
					  }
				} else {
					echo "error at interested rider.";
				}
				$index++;
	// 			$conn->close();
			}
			echo "</tbody></table></div>";
			echo "<div>No. of results: ".$index."</div>";
		} else {
			echo "<h3>No interested riders (Unconfirmed offer).</h3>";
		}
	}
} else {
	echo "Why am I here?";
}
$conn->close();	
?>