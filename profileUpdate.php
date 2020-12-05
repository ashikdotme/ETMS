<?php require_once('header.php');

$user_id = $_GET['uid'];



if(isset($_POST['update_profile'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $blood_group = $_POST['blood_group'];
    $fathers_name = $_POST['father_name'];
    $mothers_name = $_POST['mother_name'];
    $f_m_mobile = $_POST['f_or_m_mobile'];
    $edu_level = $_POST['edu'];
    $address = $_POST['address'];


    if(empty($first_name)){
        $error = "First Name is Required!";
    }
    else if(empty($last_name)){
        $error = "Last Name is Required!";
    }
     
    else if(empty($fathers_name)){
        $error = "Fathers's Name is Required!";
    }
    else if(empty($mothers_name)){
        $error = "Mother's Name is Required!";
    }
    else if(empty($f_m_mobile)){
        $error = "Father's or Mother's Number is Required!";
    }
     
    else{

        $stm=$pdo->prepare("UPDATE em_users SET first_name=?,last_name=?,birthday=?,blood_group=?,father_name=?,mother_name=?,f_or_m_mobile=?,edu=?,address=? WHERE u_id=?");

        $stm->execute(array($first_name,$last_name,$birthday,$blood_group,$fathers_name,$mothers_name,$f_m_mobile,$edu_level,$address,$user_id));

        $success = "Profile Update Successfully!";
    }


}



// Get Data From Database;
$stm=$pdo->prepare("SELECT * FROM em_users WHERE u_id=?");
$stm->execute(array($user_id));
$result=$stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$birthday = $row['birthday'];
	$blood_group = $row['blood_group'];
	$father_name = $row['father_name'];
	$mother_name = $row['mother_name'];
	$f_or_m_mobile = $row['f_or_m_mobile'];
	$edu = $row['edu'];
	$address = $row['address'];
}

 ?>

<h1 class="h3 mb-4 text-gray-800 d-inline-block">Update Profile</h1>
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
                <?php endif; ?>


				<div class="form-group">
					<label for="f_name">First Name</label>
					<input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control" id="f_name">
				</div>

				<div class="form-group">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control" id="last_name">
				</div>

				<div class="form-group">
					<label for="birthday">Birthday</label>
					<input type="date" name="birthday" value="<?php echo $birthday; ?>" class="form-control" id="birthday">
				</div>

				<div class="form-group">
					<label for="blood_group">Blood Group</label>
 					<select name="blood_group" class="form-control " id="blood_group">

                        <option value="<?php echo $blood_group; ?>" selected><?php echo $blood_group; ?></option>

                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
				</div>

				<div class="form-group">
					<label for="father_name">Father's Name</label>
					<input type="text" name="father_name" class="form-control" id="father_name" value="<?php echo $father_name; ?>">
				</div>

				<div class="form-group">
					<label for="mother_name">Mother's Name</label>
					<input type="text" name="mother_name" class="form-control" id="mother_name" value="<?php echo $mother_name; ?>">
				</div>
				<div class="form-group">
					<label for="f_or_m_mobile">Father or Mother Mobile</label>
					<input type="text" name="f_or_m_mobile" class="form-control" id="f_or_m_mobile" value="<?php echo $f_or_m_mobile; ?>">
				</div>

				<div class="form-group">
					<label for="edu">Education</label>
					<input type="text" name="edu" class="form-control" id="edu" value="<?php echo $edu; ?>">
				</div>

				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" name="address" class="form-control" id="address" value="<?php echo $address ?>">
				</div>

				<div class="form-group">
					<input type="submit" name="update_profile" value="Update Profile" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>