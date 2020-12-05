<?php require_once('header.php');

$user_id = $_SESSION['em_user'][0]['u_id'];



if(isset($_POST['change_password'])){

    $c_password = $_POST['c_password'];
    $new_password = $_POST['new_password'];
    $c_new_password = $_POST['c_new_password'];
   
    $db_password = em_user($user_id,'password');

    if(empty($c_password)){
        $error = "Current Password is Required!";
    }
    else if(empty($new_password)){
        $error = "New Password is Required!";
    }
     
    else if(empty($c_new_password)){
        $error = "Confirm New Password is Required!";
    }
    else if($new_password != $c_new_password){
    	$error = "New Password and Confirm New Password Not Match!";
    }
    
    else{

    	$c_password = SHA1($c_password);
    	if($c_password != $db_password){
    		$error = "Current Password Not Match!";
    	}else{
    		$new_password = SHA1($new_password);

    		$stm=$pdo->prepare("UPDATE em_users SET password=? WHERE u_id=?");

        	$stm->execute(array($new_password,$user_id));

        	$success = "Password Changed Successfully!";
    	}

        
    }


}



 ?>

<h1 class="h3 mb-4 text-gray-800 d-inline-block">Change Password</h1>
<div class="row">
	<div class="col-md-6">
		<div class="profileDetails">
			<form action="" method="POST">

	            <?php if(isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($success)) : ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                    <script>
                    	setTimeout(function(){
                    		window.location="logout.php";
                    	},3000)
                    </script>
                <?php endif; ?>


				<div class="form-group">
					<label for="c_password">Current Password</label>
					<input type="password" name="c_password" class="form-control" id="c_password">
				</div>

				<div class="form-group">
					<label for="new_password">New Password</label>
					<input type="password" name="new_password" class="form-control" id="new_password">
				</div>

				<div class="form-group">
					<label for="c_new_password">Confirm New Password</label>
					<input type="password" name="c_new_password" class="form-control" id="c_new_password">
				</div>

				

				<div class="form-group">
					<input type="submit" name="change_password" value="Change Password" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>