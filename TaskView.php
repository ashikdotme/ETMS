<?php require_once('header.php'); 
if(isset($_COOKIE['rememberUser'])){
    $user_id = $_COOKIE['rememberUser'];
}else{
    $user_id = $_SESSION['em_user'][0]['u_id'];
}

$tid = $_REQUEST['tid'];



if(isset($_POST['submit_work'])){
  $work_details = $_POST['work_details'];
  $status = "Submitted";
  $updated_at = date('Y-m-d H:i:s');

  if(empty($work_details)){
    $error = "Field is Required!";
  }else{
    $stm=$pdo->prepare("UPDATE em_task SET work_details=?,updated_at=?,status=? WHERE user_id=? AND t_id=?");
    $stm->execute(array($work_details,$updated_at,$status,$user_id,$tid));
    $success = "Work Submitted Successfully!";
  }
}

$stm=$pdo->prepare("SELECT * FROM em_task WHERE user_id=? AND t_id=? ORDER BY t_id ASC");
$stm->execute(array($user_id,$tid ));
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
 foreach ($result as $row){
  $name = $row['task_name'];
  $datails = $row['task_details'];
  $date_time = $row['date_time'];
  $submit_date_time = $row['submit_date_time'];
  $status = $row['status'];
  $work_details = $row['work_details'];
  $review = $row['review'];
  $review_date = $row['review_date'];
 }




?>
<h1 class="h3 mb-4 text-gray-800">View Task</h1> 
 
<div class="row">
  <div class="col-md-8">
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Task: <?php echo $name; ?></h6>
    </div>
    <?php if(isset($error)): ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if(isset($success)): ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <div class="card-body">
      <table class="table">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $name; ?></td>
        </tr>
        <tr>
          <td><b>Details:</b></td>
          <td><?php echo $datails; ?></td>
        </tr>
        <tr>
          <td><b>Deadline:</b></td>
          <td><?php echo date('d-m-Y',strtotime($date_time))." <b>To</b> ".date('d-m-Y',strtotime($submit_date_time))?></td>
        </tr>
        <tr>
          <td><b>Status:</b></td>
          <td> <?php 
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
              ?>
                      
          </td>
        </tr>
      </table>

      <?php if($status != 'Completed') : ?>
        <?php if($status == 'Modification' OR $status == 'NotApproved') : ?>
          <div class="alert alert-warning">
            <b>Review Date:</b> <?php echo date('d-m-Y h:i A',strtotime($review_date)); ?> <br>
            <b>Review Work:</b> <?php echo $review; ?>
          </div>

        <?php endif; ?>
        <form action="" method="POST">
          <div class="form-group">
            <label for="work_details">Work: <small>if you need upload any files, share link on box..</small></label>
            <textarea name="work_details" class="form-control " id="work_details"><?php echo $work_details; ?></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="submit_work" value="Submit Work" class="btn btn-success">
          </div>
        </form>
        <?php else: ?>
          <p><b>Your work is:</b> <?php echo $work_details; ?></p>
 
          <div class="alert alert-success">
            <b>Review Date:</b> <?php echo date('d-m-Y h:i A',strtotime($review_date)); ?> <br>
            <b>Review Work:</b> <?php echo $review; ?>
          </div>
        <?php endif; ?>
      </div>
</div>

  </div>
</div>



<?php require_once('footer.php'); ?>