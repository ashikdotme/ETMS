<?php require_once('header.php'); ?>
 
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>All Employee</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Photo</th>
                <th>Father's Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            	<?php 
            	$stm=$pdo->prepare("SELECT * FROM em_users");
            	$stm->execute();
            	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
            	$a=1;
            	foreach($result as $row) :
            	 ?>
             	<tr>
                	<td><?php echo $a;$a++; ?></td>
                	<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                	<td><?php echo $row['email']; 
                	if($row['email_verify'] == 1){
                		echo ' <span title="Email Verified" class="verify_status"><i class="fa fa-check"></i></span>';
                	}else{
                		echo ' <span title="Email Not Verified" class="not_verify_status"><i class="fa fa-times"></i></span>';
                	}
                	?></td>
                	<td><?php echo $row['mobile']; 
                	if($row['mobile_verify'] == 1){
                		echo ' <span title="Mobile Verified" class="verify_status"><i class="fa fa-check"></i></span>';
                	}else{
                		echo ' <span title="Mobile Not Verified" class="not_verify_status"><i class="fa fa-times"></i></span>';
                	}
                	?></td>
                	<td><img width="35" src="<?php
                	$photo = $row['photo'];
                	if($photo == null){
                        echo "../assets/img/undraw_profile.svg";
                    }else{
                        echo "../profilephotos/".$photo;                                        
                    }
                	?>" alt="Photo"></td>
                	<td><?php echo $row['father_name']; ?></td>
                	<td>
                		<a href="#" data-toggle="modal" data-target="#viewModal<?php echo $row['u_id'];?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                		<a href="#" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                		<a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                		 <!-- View Details -->
				        <div class="modal fade" id="viewModal<?php echo $row['u_id'];?>" tabindex="-1" role="dialog" aria-labelledby="viewModal"
				          aria-hidden="true">
				          <div class="modal-dialog" role="document">
				            <div class="modal-content">
				              <div class="modal-header">
				                <h5 class="modal-title border-bottom" id="exampleModalLabel"><?php echo $row['first_name']." ".$row['last_name']; ?>'s  Details</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                  <span aria-hidden="true">&times;</span>
				                </button>
				              </div>
				              <div class="modal-body">
				                <table class="table">
				                	<tr>
				                		<td>Father's Name:</td> 
				                		<td><?php echo $row['father_name'];?></td>
				                	</tr>
				                	<tr>
				                		<td>Mothers's Name</td>
				                		<td><?php echo $row['mother_name'];?></td>
				                	</tr>
				                	<tr>
				                		<td>Father or Mothers Mobile</td>
				                		<td><?php echo $row['f_or_m_mobile'];?></td>
				                	</tr>
				                	<tr>
				                		<td>Birthday</td>
				                		<td><?php echo $row['birthday'];?></td>
				                	</tr>
				                	<tr>
				                		<td>Blood Group</td>
				                		<td><?php echo $row['blood_group'];?></td>
				                	</tr>
				                	<tr>
				                		<td>Education</td>
				                		<td><?php echo $row['edu'];?></td>
				                	</tr>
				                	<tr>
				                		<td>Address</td>
				                		<td><?php echo $row['address'];?></td>
				                	</tr>
				                </table>
				              </div>
				              
				            </div>
				          </div>
				        </div>
				        <!-- End View Modal -->

                	</td>
                
              	</tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
       

<?php require_once('footer.php'); ?>