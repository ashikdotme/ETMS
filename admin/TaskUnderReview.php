<?php require_once('header.php'); ?>
 
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Review Task</h4>
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
                <th>Title</th>
                <th>Assign Date</th>
                <th>Deadline</th>
                <th>Status</th>  
                <th>Action</th>  
              </tr>
            </thead>
            <tbody>
              <?php 
              $stm=$pdo->prepare("SELECT * FROM em_task WHERE status != ?");
              $stm->execute(array('Completed'));
              $result=$stm->fetchAll(PDO::FETCH_ASSOC);
              $a=1;
              foreach($result as $row):
               ?>
              <tr>
                <td><?php echo $a;$a++; ?></td>
                <td><?php echo em_user($row['user_id'],'first_name')." ".em_user($row['user_id'],'last_name'); ?></td>
                <td><?php echo $row['task_name']; ?></td>
                <td><?php echo date('d-M-Y h:i A',strtotime($row['date_time'])) ;?></td>
                <td><?php echo date('d-M-Y',strtotime($row['submit_date_time'])) ;?></td>
                <td><?php 
                $status = $row['status'];
                if($status == 'Pending'){
                  echo '<span class="badge badge-warning">Pending</span>';
                }
                else if($status == 'Submitted'){
                  echo '<span class="badge badge-info">Submitted</span>';
                } 
                else if($status == 'Modification'){
                  echo '<span class="badge badge-warning">Modification</span>';
                }
                else if($status == 'Completed'){
                  echo '<span class="badge badge-success">Completed</span>';
                }
                 else if($status == 'NotApproved'){
                  echo '<span class="badge badge-danger">Not Approved</span>';
                }
                ?></td>
                <td><a href="TaskView.php?tid=<?php echo $row['t_id'];?>" class="btn btn-success"><i class="fa fa-eye"></i> view</a></td>
              </tr>
              <?php  endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
       

<?php require_once('footer.php'); ?>