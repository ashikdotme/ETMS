<?php require_once('header.php'); ?>
 
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Today Attendance ~ <span>Today: <?php echo date('d-M-Y - h:i A'); ?></span></h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                <th>Name</th>
                <th>Attendace</th>
                <th>Time</th>
                <th>Sys Time</th>
                <th>Location</th>  
                <th>Action</th>  
              </tr>
            </thead>
            <tbody>
            	<?php 
            	$stm=$pdo->prepare("SELECT * FROM em_users");
            	$stm->execute();
            	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
            	$a=1;
              $today = date('Y-m-d');
            	foreach($result as $row) :
            	 ?>
             	<tr> 
                	<td><?php echo $a;$a++; ?></td>
                	<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                	<td><?php 
                  if(checkAttendance($row['u_id'],$today) == 1 ){
                    echo '<span class="btn btn-success btn-circle btn-sm"><i class="fas fa-check "></i></span>';
                  }else{
                    echo '<span class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times "></i></span>';
                  }
                   ?></td>
                  
                  
                	<td><?php 
                  if(checkAttendance($row['u_id'],$today) == 1 ){
                    $userTime = checkAttInfo($row['u_id'],$today,'user_time');
                    echo date('h:i A',strtotime($userTime));

                  }else{
                    echo '<span class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times "></i></span>';
                  }
                   ?></td>
                	<td>
                   <?php 
                  if(checkAttendance($row['u_id'],$today) == 1 ){
                    $userTime = checkAttInfo($row['u_id'],$today,'system_time');
                    echo date('h:i A',strtotime($userTime));

                  }else{
                    echo '<span class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times "></i></span>';
                  }
                   ?> 
                  </td>
                	<td>
                   <?php 
                   if(checkAttendance($row['u_id'],$today) == 1 ){
                    ?>
                    <a href="#" data-toggle="modal" data-target="#viewModal<?php echo $row['u_id'];?>" class="btn btn-success"><i class="fa fa-eye"> View</i></a>


                    <div class="modal fade" id="viewModal<?php echo $row['u_id'];?>" tabindex="-1" role="dialog" aria-labelledby="viewModal"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title border-bottom" id="exampleModalLabel"><?php echo $row['first_name']." ".$row['last_name']; ?>'s  Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <?php 
                          $latitude = checkAttInfo($row['u_id'],$today,'latitude') ;
                          $longitude = checkAttInfo($row['u_id'],$today,'longitude');
                           ?>
                          <iframe style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $latitude; ?>,<?php echo $longitude;?>&amp;key=AIzaSyCw-BKYqt_gpvdrB6kAu30hN8t_jugXaPU" width="100%" height="450" frameborder="0"></iframe>

                          </div>
                          
                        </div>
                      </div>
                    </div> 

                    <?php 

                  }else{
                    echo '<span class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times "></i></span>';
                  }
                    ?> 
                  </td> 

                  <td>
                   <?php 
                   if(checkAttendance($row['u_id'],$today) == 1 ){
                    ?>
                    <a href="#" data-toggle="modal" data-target="#moreModal<?php echo $row['u_id'];?>" class="btn btn-success"><i class="fa fa-eye"> More</i></a>


                    <div class="modal fade" id="moreModal<?php echo $row['u_id'];?>" tabindex="-1" role="dialog" aria-labelledby="viewModal"
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
                          <?php 
                          $ip_address = checkAttInfo($row['u_id'],$today,'ip_address') ;
                          $device_details = checkAttInfo($row['u_id'],$today,'device_details');
                           ?>
                          
                          <table class="table">
                            <tr>
                              <td>Ip Address: </td>
                              <td><?php echo $ip_address; ?></td>
                            </tr>
                            <tr>
                              <td>Device Details: </td>
                              <td><?php echo $device_details; ?></td>
                            </tr>
                          </table>
                          </div>
                          
                        </div>
                      </div>
                    </div> 

                    <?php 

                  }else{
                    echo '<span class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times "></i></span>';
                  }
                    ?> 
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