<?php require_once('header.php');

if(isset($_COOKIE['rememberUser'])){
    $user_id = $_COOKIE['rememberUser'];
}else{
    $user_id = $_SESSION['em_user'][0]['u_id'];
}

if(isset($_POST['update_photo'])){

    $photo = $_FILES['p_photo'];
    $name = $_FILES['p_photo']['name'];
    $size = $_FILES['p_photo']['size'];
    $tmp_name = $_FILES['p_photo']['tmp_name'];

    $extension = pathinfo($name,PATHINFO_EXTENSION);



    if(empty($name)){
        $error = "Upload Field is Required!";
    }
    else if($extension != 'PNG' AND $extension != 'png' AND $extension != 'JPG' AND $extension != 'jpg' AND $extension != 'jpeg' AND $extension != 'JPEG' AND $extension != 'GIF' AND $extension != 'gif'){

        $error = "Please Attach jpg | png | gif";
    }
    else{

        $newname = $user_id.".".$extension;
        $upload=move_uploaded_file($tmp_name, 'profilephotos/'.$newname);

        $stm=$pdo->prepare("UPDATE em_users SET photo=? WHERE u_id=?");
        $stm->execute(array($newname,$user_id));

        if($upload == true){
            $success = "Profile Photo Update Success!";
        }else{
            $error = "Upload Faild!";
        }

    }


}



 ?>

<h1 class="h3 mb-4 text-gray-800 d-inline-block">Update Profile Photo</h1>
<div class="row">
	<div class="col-md-6">
		<div class="profileDetails">
			<form action="" method="POST" enctype="multipart/form-data">

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
					<label for="c_password">Upload Photo</label>
					<input type="file" name="p_photo" class="form-control" id="c_password">
				</div>

				<div class="form-group">
					<input type="submit" name="update_photo" value="Update Photo" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>