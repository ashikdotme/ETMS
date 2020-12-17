<?php require_once('header.php'); 
$user_id = $_SESSION['em_user'][0]['u_id'];

?>
<h1 class="h3 mb-4 text-gray-800">All Attendance</h1> 
 
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Attendance</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Attendance</th> 
                        <th>Date</th> 
                    </tr>
                </thead>
                
                <tbody>
                
                  	<?php 
                  	$start_date = 1;
                  	$end_date = date('d');

                  	for ($i=$start_date; $i <= $end_date; $i++) { 

                  		$check_date = date('Y-m-').$i;

                  		if(checkAttendance($user_id,$check_date) == 1 ):
                  		
                  		;?>
                  			<tr>
		                        <td><?php echo $i;?></td>
		                        <td><?php 
		                        echo em_user($user_id,'first_name')." ".em_user($user_id,'last_name'); ?>
		                        </td>
		                        
		                        <td><?php 
		                        $userTime = checkAttInfo($user_id,$check_date,'user_time');
		                        echo date('h:i A',strtotime($userTime)); ?></td>
		                        
		                        <td>
		                        <?php 
		                        $attendance = checkAttInfo($user_id,$check_date,'attendance');
		                        if($attendance == 1){
		                        	echo '<span class="btn btn-success btn-circle btn-sm"><i  class="fas fa-check "></i></span>';
		                        }else{
		                        	echo '<span class="btn btn-danger btn-circle btn-sm"><i  class="fas fa-times "></i></span>';
		                        }

		                         ?></td> 
		                        
		                        <td><?php echo date('d-M-Y',strtotime($check_date)) ?></td> 
		                    </tr>

                    	<?php else : ?>
                  		
                  			<tr>
		                      <td><?php echo $i; ?></td>
		                      <td><?php 
		                        echo em_user($user_id,'first_name')." ".em_user($user_id,'last_name'); ?>
		                        </td>
		                      <td><?php echo '<span class="btn btn-danger btn-circle btn-sm"><i  class="fas fa-times "></i></span>'; ?></td>
		                     <td><?php echo '<span class="btn btn-danger btn-circle btn-sm"><i  class="fas fa-times "></i></span>'; ?></td>
		                       <td><?php echo date('d-M-Y',strtotime($check_date)) ?></td> 
		                    </tr>

                  		<?php endif;

                  	}

                  	 ?>
                  	
                  	









                </tbody>
            </table>
        </div>
    </div>
</div>



<?php require_once('footer.php'); ?>