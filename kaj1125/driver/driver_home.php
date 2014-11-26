<?php if (!isset($_SESSION)) session_start(); ?>
<head>
<script type="text/javascript">
$(document).ready(function() {
    $("#datepicker_driver").datepicker();
    $("#offer_history_driver").load("app/driver_scripts/history_driver_page.php");
    $("#interested_riders").load("app/driver_scripts/interested_rider.php");
//     $("#pending_rides_driver").load("pending_rides_driver.php");
    $("#confirmed_rides_driver").load("app/driver_scripts/update_confirm_driver.php");
    $("#submit_driver").click(function()
  	{
  	    var startTime = $("#startTimeHour_driver").val()
  	    				+ $("#startTimeMin_driver").val();
  	    var endTime = $("#endTimeHour_driver").val()
  	    				+ $("#endTimeMin_driver").val();
  	    if (startTime < 100) {
  	    	startTime = startTime * 100;
  	    }
  	    
  	    if (endTime < 100) {
  	    	endTime = endTime * 100;
  	    }

   		$.ajax(
      	{
            url: "app/driver_scripts/insert_match_driver_page.php",
            type: "POST",
        	data:
        	{
            	locFrom: $("#locFrom_driver").val(),
                locTo: $("#locTo_driver").val(),
                timeFrom: startTime,
                timeTo: endTime,
                date: $("#datepicker_driver").val(),
                max: $("#maxRiders").val(),
                price: $("#price").val(),
        	},
            dataType: "text",
        	success: function(dat)
        	{	
        		$("#offer_history_driver").load("app/driver_scripts/history_driver_page.php");
        		$("#update_driver").html("<span style='color:green;'> Your offer is updated! </span>");
				$("#result_driver").html(dat);
        	},
    	});
	});
});

function sendRequest_Driver(driver_event_id,driver_id,rider_event_id,rider_id) {
	$.ajax(
    {
        url: "app/sendRequest.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	DriverID: driver_id,
        	RiderEventID: rider_event_id,
        	RiderID: rider_id,
        	WhoRequestThis: 1, // driver
        	
        },
        dataType: "text",
        success: function(dat)
        {
// 			$("#pending_rides_driver").load("pending_rides_driver.php");
        	alert("Request sent!");
        	console.log(dat);
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

function deleteOffer_Driver(driver_event_id) {
	$.ajax(
    {
        url: "app/deleteOffer.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	
        },
        dataType: "text",
        success: function(dat)
        {
        	$("#offer_history_driver").load("app/driver_scripts/history_driver_page.php");
        	alert("Deleted!");
        	console.log(dat);
        	
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

function confirm(driver_event_id,driver_id,rider_event_id,rider_id) {
	$.ajax(
    {
        url: "app/confirm.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	DriverID: driver_id,
        	RiderEventID: rider_event_id,
        	RiderID: rider_id,
        	
        },
        dataType: "text",
        success: function(dat)
        {
        	alert("Confirm!");
        	console.log(dat);
        	$("#interested_riders").load("app/driver_scripts/interested_rider.php"); // why doesn't reload?
        	$("#confirmed_rides_driver").load("app/driver_scripts/update_confirm_driver.php");
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

</script>
</head>

<div id="bottom">
	<p><h1>Driver Home Page</h1></p>
	<div id="search_driver" style=>
		Location From: <input type='text' id = 'locFrom_driver'/>
		Location To: <input type='text' id = 'locTo_driver'/>
		Date: <input type="text" id="datepicker_driver"/>
		Pickup time (Hour:Min): Between
		<select id='startTimeHour_driver'>
		  <option value="00">00</option>
		  <option value="01">01</option>
		  <option value="02">02</option>
		  <option value="03">03</option>
		  <option value="04">04</option>
		  <option value="05">05</option>
		  <option value="06">06</option>
		  <option value="07">07</option>
		  <option value="08">08</option>
		  <option value="09">09</option>
		  <option value="10">10</option>
		  <option value="11">11</option>
		  <option value="12">12</option>
		  <option value="13">13</option>
		  <option value="14">14</option>
		  <option value="15">15</option>
		  <option value="16">16</option>
		  <option value="17">17</option>
		  <option value="18">18</option>
		  <option value="19">19</option>
		  <option value="20">20</option>
		  <option value="21">21</option>
		  <option value="22">22</option>
		  <option value="23">23</option>
		</select>:
		<select id='startTimeMin_driver'>
		  <option value="00">00</option>
		  <option value="01">01</option>
		  <option value="02">02</option>
		  <option value="03">03</option>
		  <option value="04">04</option>
		  <option value="05">05</option>
		  <option value="06">06</option>
		  <option value="07">07</option>
		  <option value="08">08</option>
		  <option value="09">09</option>
		  <option value="10">10</option>
		  <option value="11">11</option>
		  <option value="12">12</option>
		  <option value="13">13</option>
		  <option value="14">14</option>
		  <option value="15">15</option>
		  <option value="16">16</option>
		  <option value="17">17</option>
		  <option value="18">18</option>
		  <option value="19">19</option>
		  <option value="20">20</option>
		  <option value="21">21</option>
		  <option value="22">22</option>
		  <option value="23">23</option>
		  <option value="24">24</option>
		  <option value="25">25</option>
		  <option value="26">26</option>
		  <option value="27">27</option>
		  <option value="28">28</option>
		  <option value="29">29</option>
		  <option value="30">30</option>
		  <option value="31">31</option>
		  <option value="32">32</option>
		  <option value="33">33</option>
		  <option value="34">34</option>
		  <option value="35">35</option>
		  <option value="36">36</option>
		  <option value="37">37</option>
		  <option value="38">38</option>
		  <option value="39">39</option>
		  <option value="40">40</option>
		  <option value="41">41</option>
		  <option value="42">42</option>
		  <option value="43">43</option>
		  <option value="44">44</option>
		  <option value="45">45</option>
		  <option value="46">46</option>
		  <option value="47">47</option>
		  <option value="48">48</option>
		  <option value="49">49</option>
		  <option value="50">50</option>
		  <option value="51">51</option>
		  <option value="52">52</option>
		  <option value="53">53</option>
		  <option value="54">54</option>
		  <option value="55">55</option>
		  <option value="56">56</option>
		  <option value="57">57</option>
		  <option value="58">58</option>
		  <option value="59">59</option>
			  
		</select>
		and 
		<select id='endTimeHour_driver'>
		  <option value="00">00</option>
		  <option value="01">01</option>
		  <option value="02">02</option>
		  <option value="03">03</option>
		  <option value="04">04</option>
		  <option value="05">05</option>
		  <option value="06">06</option>
		  <option value="07">07</option>
		  <option value="08">08</option>
		  <option value="09">09</option>
		  <option value="10">10</option>
		  <option value="11">11</option>
		  <option value="12">12</option>
		  <option value="13">13</option>
		  <option value="14">14</option>
		  <option value="15">15</option>
		  <option value="16">16</option>
		  <option value="17">17</option>
		  <option value="18">18</option>
		  <option value="19">19</option>
		  <option value="20">20</option>
		  <option value="21">21</option>
		  <option value="22">22</option>
		  <option value="23">23</option>
		</select>:
		<select id='endTimeMin_driver'>
		  <option value="00">00</option>
		  <option value="01">01</option>
		  <option value="02">02</option>
		  <option value="03">03</option>
		  <option value="04">04</option>
		  <option value="05">05</option>
		  <option value="06">06</option>
		  <option value="07">07</option>
		  <option value="08">08</option>
		  <option value="09">09</option>
		  <option value="10">10</option>
		  <option value="11">11</option>
		  <option value="12">12</option>
		  <option value="13">13</option>
		  <option value="14">14</option>
		  <option value="15">15</option>
		  <option value="16">16</option>
		  <option value="17">17</option>
		  <option value="18">18</option>
		  <option value="19">19</option>
		  <option value="20">20</option>
		  <option value="21">21</option>
		  <option value="22">22</option>
		  <option value="23">23</option>
		  <option value="24">24</option>
		  <option value="25">25</option>
		  <option value="26">26</option>
		  <option value="27">27</option>
		  <option value="28">28</option>
		  <option value="29">29</option>
		  <option value="30">30</option>
		  <option value="31">31</option>
		  <option value="32">32</option>
		  <option value="33">33</option>
		  <option value="34">34</option>
		  <option value="35">35</option>
		  <option value="36">36</option>
		  <option value="37">37</option>
		  <option value="38">38</option>
		  <option value="39">39</option>
		  <option value="40">40</option>
		  <option value="41">41</option>
		  <option value="42">42</option>
		  <option value="43">43</option>
		  <option value="44">44</option>
		  <option value="45">45</option>
		  <option value="46">46</option>
		  <option value="47">47</option>
		  <option value="48">48</option>
		  <option value="49">49</option>
		  <option value="50">50</option>
		  <option value="51">51</option>
		  <option value="52">52</option>
		  <option value="53">53</option>
		  <option value="54">54</option>
		  <option value="55">55</option>
		  <option value="56">56</option>
		  <option value="57">57</option>
		  <option value="58">58</option>
		  <option value="59">59</option>
		</select>
		Maximum Riders: <input type='text' id = 'maxRiders'/>
		Price for one ride: <input type='text' id = 'price'/>
		<button id="submit_driver">Submit!</button>
	</div>
	<div id="update_driver"></div>

	<div id="result_driver"></div>
	<div id="offer_history_driver"></div>
	<div id="interested_riders"></div>
	<div id="pending_rides_driver"></div>
	<div id="confirmed_rides_driver"></div>


</div>


