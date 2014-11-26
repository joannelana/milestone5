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
$max = $_POST['max'];
$price = $_POST['price'];
$DriverID = $_SESSION['id'];
$familyname = $_SESSION['familyname'];
$givenname = $_SESSION['givenname'];

include("../function.php");

$conn = connDB();
$sql = "Insert into DriverOffers VALUES('$locFrom','$locTo',
		'$timeFrom','$timeTo','$price','$EtId','$DriverID','$date','$max',0,0,'$familyname','$givenname')";

if ($conn->query($sql))
{
	$conn->close();
	
	$conn = connDB();
	
	$DriverRequestedEvents = $conn->query("Select * from RiderRequest 
	WHERE PickupPlace='$locFrom' AND Date='$date' AND Destination='$locTo'");
	
	if (mysqli_num_rows($DriverRequestedEvents) > 0)
	{
		echo "<div class='table_admin' class='span7'>
				<h3>Search Results: Matched Rides from Riders</h3>";
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
					<th>Invite</th>
				  </tr>";
				
		  
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($DriverRequestedEvents))
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
            echo'<td data-th="Invite"><button class="join" onclick="sendRequest_Driver('
			.$EtId.','.$DriverID.','.$row['RiderEventID'].','.$row['RiderID'].')">Invite</button></td>';
			echo'</tr>';
			
		  }
		  	echo "</tbody></table></div>";
	        echo "<div>No. of results: ".$count."</div>";
	} else {
		
		echo "<h3>No search results available. Better luck next time!=P</h3>";
	}
	
	
}
else
{
	"<h3>No search results available. Better luck next time!=P</h3>";
}	

$conn->close();
?>
