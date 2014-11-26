<?php

if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn=connDB();

$RiderID = $_SESSION['id'];

$results = $conn->query("Select * from PendingRides WHERE RiderID='$RiderID' AND WhoRequestThis=2");

if($results === TRUE){ // there are results
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
					<th>Invite</th>
				  </tr>";
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($results))
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
            echo'<td data-th="Invite"><button class="join" onclick="deleteOffer('
			.$row['RiderEventID'].')">Delete</button></td>';
			echo'</tr>';
			
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