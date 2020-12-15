<?php require_once('header.php'); ?>
<h1 class="h3 mb-4 text-gray-800">Attendance</h1>
<?php 
$user_id = $_SESSION['em_user'][0]['u_id'];
if(isset($_POST['submit_attendance'])){
	$user_id = $_SESSION['em_user'][0]['u_id'];
	$ip_address = $_SERVER['SERVER_ADDR'];
	$device_details = $_SERVER['HTTP_USER_AGENT'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$sys_time = date('Y-m-d H:i:s');

	$attendance = $_POST['attendance'];
	$att_datetime = $_POST['att_datetime'];
	// 12/15/2020 05:10 PM
	$date = $att_datetime;
	$date = str_replace('/', '-', $date);
	$newdate = date('Y-m-d H:i:s', strtotime($date));
	
	$today = date('Y-m-d');
	$today_attendance = em_att_submit($today,$user_id);

	if(empty($att_datetime)){
		$error = "Date Time is Required!";
	}
	else if($today_attendance == 1){
		$error = "Already Submitted your Attendance.";
	}
	else{


		$stm = $pdo->prepare("INSERT INTO em_attendance(
			em_id,attendance,user_time,system_time,latitude,longitude,ip_address,device_details
		) VALUES(?,?,?,?,?,?,?,?)");
		$stm->execute(array($user_id,$attendance,$newdate,$sys_time,$latitude,$longitude,$ip_address,$device_details));

		$success = "Attendance Submit Successfully!";



	}

}

 ?>

<div class="row">
	
	<div class="col-md-6">
		<div class="card shadow">
			 
			<form action="" class="form" method="POST">
				<?php if(isset($error)) : ?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
				<?php endif; ?>

				<?php if(isset($success)) : ?>
				<div class="alert alert-success">
					<?php echo $success; ?>
				</div>
				<?php endif; ?>

				<div class="alert alert-danger" id="locationError">
					
				</div>

				<?php 
					$today = date('Y-m-d');
					$today_attendance = em_att_submit($today,$user_id);

				if($today_attendance == 1 ) : ?>
				<div class="alert alert-success">
					Already Submitted your Attendance.
				</div>
				<?php endif; ?>


				<div class="form-group">
					<label for="attendance">
					    <input class="custom-checkbox" value="1" type="checkbox" name="attendance" id="attendance" checked> Present
					</label>
				</div>

                <div class="form-group">
					<label for="att_datetime"><b>Date Time:</b></label>
					    <input class="form-control"   type="text" name="att_datetime" id="att_datetime" placeholder="Select your In Time"> 

				</div>
 				<input type="hidden" name="latitude" id="latitude">
 				<input type="hidden" name="longitude" id="longitude">
 				<div class="form-group"> 
 					<input type="submit" class="btn btn-success" name="submit_attendance" value="Submit Attendance" id="submit_attendance" disabled>
 				</div>

			</form>
			 
		</div>
	</div>

</div>



<?php require_once('footer.php'); ?>

<script>

function getLoction(){
	$('#locationError').hide();
	navigator.geolocation.getCurrentPosition(function(position){
		let lati = position.coords.latitude;
		let log = position.coords.longitude;
		$('#latitude').val(lati);
		$('#longitude').val(log);

		$('#submit_attendance').attr('disabled',false);
	},
	function showError(error){
		$('#locationError').show();

		$('#submit_attendance').attr('disabled',true);

		if(error.PERMISSION_DENIED){
			$('#locationError').text("PERMISSION DENIED.");
		}
		else if(error.POSITION_UNAVAILABLE){
			$('#locationError').text("POSITION UNAVAILABLE.");
		}
		else if(error.TIMEOUT){
			$('#locationError').text("Location Request Timeout.");
		}
		else if(error.UNKNOWN_ERROR){
			$('#locationError').text("An unknown error occurred.");
		}
	}
	);
}
getLoction();


</script>

