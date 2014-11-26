<?php if (!isset($_SESSION)) session_start(); ?>
<head>
<script type="text/javascript">
$(document).ready(function() {
    $("#datepicker").datepicker();
    $("#rider_history").load("app/rider_scripts/history_rider_page.php");
    $("#interested_drivers").load("app/rider_scripts/interested_driver.php");
//     $("#pending_rides_rider").load("pending_rides_rider.php");
    $("#confirmed_rides_rider").load("app/rider_scripts/update_confirm_rider.php");
    $("#submit_rider").click(function()
  	{
  	    var startTime = $("#startTimeHour").val()
  	    				+ $("#startTimeMin").val();
  	    var endTime = $("#endTimeHour").val()
  	    				+ $("#endTimeMin").val();
  	    if (startTime < 100) {
  	    	startTime = startTime * 100;
  	    }
  	    
  	    if (endTime < 100) {
  	    	endTime = endTime * 100;
  	    }
  	    
  	    $("#update").empty();
   		$.ajax(
      	{
            url: "app/rider_scripts/insert_match_rider_page.php",
            type: "POST",
        	data:
        	{
            	locFrom: $("#locFrom").val(),
                locTo: $("#locTo").val(),
                timeFrom: startTime,
                timeTo: endTime,
                date: $("#datepicker").val(),
                sort: $("#sort").val(),
        	},
            dataType: "text",
        	success: function(dat)
        	{	
        		$("#rider_history").load("app/rider_scripts/history_rider_page.php");
        		$("#update").html("<span style='color:green;'> Your request history is updated! </span>");
				$("#result").html(dat);
        	},
    	});
    	
    	
		
	}); 
});

function sendRequest_Rider(driver_event_id,driver_id,rider_event_id,rider_id) {
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
        	WhoRequestThis: 2, // rider
        	
        },
        dataType: "text",
        success: function(dat)
        {
// 			$("#pending_rides_rider").load("pending_rides_rider.php");
        	alert("Request sent!");
        	console.log(dat);
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

function deleteOffer_Rider(rider_event_id) {
	$.ajax(
    {
        url: "app/deleteOffer.php",
	    type: "POST",
    	data:
        {
        	RiderEventID: rider_event_id,
        	
        },
        dataType: "text",
        success: function(dat)
        {
        	$("#rider_history").load("app/rider_scripts/history_rider_page.php");
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
        	$("#interested_drivers").load("app/rider_scripts/interested_driver.php");
        	$("#confirmed_rides_rider").load("app/rider_scripts/update_confirm_rider.php");
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}
</script>
</head>

<style type = "text/css">
.general_from_to{
	float:left;
	width:57%;
}
.hours{
	float:left;
	height:30px;
	font-family: arial;
	font-size:15px;
}
.hours * {
	float: left;
	padding: 0;
}
.hours span {
	width: 1px;
	position: relative;
	left: 2px;
	height: 46px;
	line-height: 37px;
	text-align: center;
}
.hours select {
	height: 39px;
	width: 46px;
}
.forms{
	float:left;
	width:100%;
}
.times{
	display: inline-block;
	position: relative;
	background: white;
	font: 12px Arial;
	color: black;
	padding: 0;
	float: left;
	text-align: center;
	border-radius: 3px;
	cursor: pointer;
	border: 1px solid #ccc;
	background: #eee;
	color: #555;
	margin-top:0px;
	height:35px;
	padding: 3px 6px;
	margin: 0px 0px 0px 8px;
	font-family: arial;
}
.types{
	display: inline-block;
	position: relative;
	background: white;
	font: 20px;
	color: black;
	padding: 0;
	float: left;
	text-align: center;
	border-radius: 3px;
	cursor: pointer;
	border: 1px solid #ccc;
	background: #eee;
	color: #555;
	margin-top:8px;
	margin-left:6px;
	height:35px;
	width: 140px;
	padding: 3px 6px;
	font-family: arial;
}
.sort{
	float: left;
	width:10%;
	height:30px;
	font-family: arial;
	font-size:15px;
}
.search_button{
	display: inline-block;
	position: relative;
	background: white;
	font: 15px;
	color: black;
	padding: 0;
	float: left;
	text-align: center;
	border-radius: 3px;
	cursor: pointer;
	border: 1px solid #ccc;
	background: #eee;
	color: #555;
	margin-top:8px;
	margin-left:6px;
	height:24px;
	width: 21px;
	padding-top:9px;
	font-family: arial;
}
</style>
<div class = "home">
	<div class = "fixed-width-centered">
		<div class = "general_from_to">
			<div class="input-group">
        		<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
        		<input class="form-control-homes" type='text' id = 'locFrom' placeholder= "From"/>
      		</div>
      		<div class="input-group">
        		<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
        		<input class="form-control-homes" type='text' id = 'locTo' placeholder = "To"/>
      		</div>
			<div class="input-group">
        		<span class="input-group-addon-homes"><i class="fa fa-calendar-o fa-fw"></i></span>
        		<input class="form-control-homes" type="text" id="datepicker" placeholder = "Depart"/>
      		</div>
      	</div>
      	<div class="hours">
			<select class = "times" id='startTimeHour'>
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
			</select>
			<span>:</span>
			<select class = "times" id='startTimeMin'>
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
			<span>-</span>
			<select class = "times"  id='endTimeHour'>
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
			</select>
			<span>:</span>
			<select class = "times" id='endTimeMin'>
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
		</div>	
		<div class= "sort">
			<a class="search_button" id="submit_rider"><i class="fa fa-search fa-fw"></i> Search &nbsp;</a>
<!-- 			<button id="submit_rider">Submit!</button> -->
		</div>
		<div style ="clear: both;"></div>
		<div class = "sort">
			<select class= "types" name='SortList' id='sort'>
				<option value="lowprice">Lowest Price</option>
				<option value="earlytime">Earliest Time</option>
				<option value="latetime">Latest Time</option>
			</select>
		</div>
		<div style ="clear: both;"></div>
		<div class = "forms">
			<div id="update"></div>
			<div id="result"></div>
			<div id="rider_history"></div>
			<div id="interested_drivers"></div>
			<div id="pending_rides"></div>
			<div id="confirmed_rides_rider"></div>
		</div>
		<div style ="clear: both;"></div>
</div>


