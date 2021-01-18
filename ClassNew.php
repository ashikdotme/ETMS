<?php require_once('header.php'); ?>
<h1 class="h3 mb-4 text-gray-800">Today Practice Class</h1>
<?php 
if(isset($_COOKIE['rememberUser'])){
    $user_id = $_COOKIE['rememberUser'];
}else{
    $user_id = $_SESSION['em_user'][0]['u_id'];
}


if(isset($_POST['submit_class'])){
	$user_id = $_SESSION['em_user'][0]['u_id'];
	$class_name = $_POST['class_name'];
	$class_details = $_POST['class_details'];
	$today = date('Y-m-d H:i:s');

	if(empty($class_name)){
		$error = "Name is Required!";
	}
	else if(empty($class_details)){
		$error = "Class Details is Required!";
	}
	 
	else{


		$stm = $pdo->prepare("INSERT INTO em_class(user_id,class_name,class_details,date_time) VALUES(?,?,?,?)");
		$stm->execute(array($user_id,$class_name,$class_details,$today));

		$success = "Class Submit Successfully!";



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
  
				<div class="form-group">
					<label for="class_name">Class Name:</label>
					<input type="text" name="class_name" class="form-control" id="class_name">
				</div>

                <div class="form-group">
					<label for="class_details">Class Details:</label>
					<textarea  name="class_details" class="form-control" id="class_details"></textarea>
				</div>
 				 
 				<div class="form-group"> 
 					<input type="submit" class="btn btn-success" name="submit_class" value="Submit" id="submit_class">
 				</div>

			</form>
			 
		</div>
	</div>

</div>


<?php require_once('footer.php'); ?>