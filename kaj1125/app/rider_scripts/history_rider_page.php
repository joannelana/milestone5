<?php
/* Insert User Info */
if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn = connDB();
$RiderID = $_SESSION['id'];

$RiderHistory = $conn->query("Select * from RiderRequest WHERE RiderID='$RiderID' AND Fulfilled=0 ORDER BY RiderEventID DESC");

if ($RiderHistory === FALSE)
{
	echo "<h3>You do not have any past requests.</h3>";
} else {
	if (mysqli_num_rows($RiderHistory) > 0)
	{
		echo "<div class='table_admin' class='span7'>
				<h3>Past Unconfirmed Requests</h3>";
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
					<th>Delete Offer</th>
				  </tr>";
				
		  
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($RiderHistory))
		  {
		    $count++;
			echo'<tr>';
			echo'<td data-th="No.">'. $count .'</td>';
			echo'<td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
			echo'<td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
			echo'<td data-th="Destination">'. $row['Destination'].'</td>';
			echo'<td data-th="Pickup Time Range (Start)">'. $row['StartTimeRange'].'</td>';
			echo'<td data-th="Pickup Time Range (End)">'. $row['EndTimeRange'].'</td>';
			echo'<td data-th="Date">'. $row['Date'].'</td>';

			echo'<td data-th="Delete Offer"><button class="delete" onclick="deleteOffer_Rider('
			.$row['RiderEventID'].')">Delete</button></td>';
			echo "</tr>";
			
		  }
		  	echo "</tbody></table></div>";
	        echo "<div>No. of results: ".$count."</div>";
	} else {
		
		echo "<h3>You do not have any past requests.</h3>";
	}
}

?>