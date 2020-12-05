<?php require_once('header.php');
$user_id = $_SESSION['em_user'][0]['u_id'];
?>

<h1 class="h3 mb-4 text-gray-800 d-inline-block">Profile</h1> &nbsp;&nbsp; &nbsp;<a class="btn btn-sm btn-info" href="profileUpdate.php?uid=<?php echo $user_id; ?>">Update Profile</a>
<div class="row">
	<div class="col-md-6">
		<div class="profileDetails">
			 
			<table class="table  table-striped">
				<tr>
					<th>First Name:</th>
					<td><?php echo em_user($user_id,'first_name');?></td> 
				</tr>

				<tr>
					<th>Last Name:</th>
					<td><?php echo em_user($user_id,'last_name');?></td> 
				</tr>

				<tr>
					<th>Email:</th>
					<td><?php echo em_user($user_id,'email');?></td> 
				</tr>

				<tr>
					<th>Mobile:</th>
					<td><?php echo em_user($user_id,'mobile');?></td> 
				</tr>

				<tr>
					<th>Birthday:</th>
					<td><?php echo em_user($user_id,'birthday');?></td> 
				</tr>

				<tr>
					<th>Blood Group:</th>
					<td><?php echo em_user($user_id,'blood_group');?></td> 
				</tr>
				<tr>
					<th>Father's Name:</th>
					<td><?php echo em_user($user_id,'father_name');?></td> 
				</tr>

				<tr>
					<th>Mother's Name:</th>
					<td><?php echo em_user($user_id,'mother_name');?></td> 
				</tr>

				<tr>
					<th>Father or Mother Mobile:</th>
					<td><?php echo em_user($user_id,'f_or_m_mobile');?></td> 
				</tr>

				<tr>
					<th>Education:</th>
					<td><?php echo em_user($user_id,'edu');?></td> 
				</tr>

				<tr>
					<th>Address:</th>
					<td><?php echo em_user($user_id,'address');?></td> 
				</tr>
			</table>
		</div>
	</div>
</div>


<?php require_once('footer.php'); ?>