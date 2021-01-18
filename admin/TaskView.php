<?php require_once('header.php');

$tid = $_GET['tid'];
 

if(isset($_POST['task_review'])){
  $tid = $_GET['tid'];
  $review = $_POST['review'];
  $status = $_POST['new_status']; 
  $review_date = date('Y-m-d H:i:s');

  $stm=$pdo->prepare("UPDATE em_task SET status=?,review=?,review_date=? WHERE t_id = ?");
  $stm->execute(array($status,$review,$review_date,$tid));
  $success = "Task Review Successfully!";

}



$stm=$pdo->prepare("SELECT * FROM em_task WHERE t_id=?");
$stm->execute(array($tid));
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
  $user_id = $row['user_id'];
  $t_name = $row['task_name'];
  $t_desc = $row['task_details'];
  $status = $row['status'];
  $work_details = $row['work_details'];
  $assign_date = $row['submit_date_time'];
  $user_submit_date = $row['updated_at'];
  $review = $row['review'];
}





 ?>
 
<div class="row">
  <div class="col-7">
    <div class="card">
      <div class="card-header border-bottom">
        <h4>View Task</h4> 
        <?php 
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
      </div>
      <div class="card-body">
        <form action="" method="POST">
          <?php if(isset($error)): ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php endif; ?>

          <?php if(isset($success)): ?>
          <div class="alert alert-success"><?php echo $success; ?></div>
          <?php endif; ?>
          
          <div class="form-group">
            <label for="em_select">Employee Name:</label>
            <p><?php echo em_user($user_id,'first_name')." ".em_user($user_id,'last_name'); ?></p>
          </div>
          
          <div class="form-group">
            <label for="task_name">Task Name:</label>
            <p><?php echo $t_name; ?></p>
          </div>

          <div class="form-group alert alert-success">
            <h6>Task Details:</h6>
            <?php echo   $t_desc; ?>
          </div>

          <div class="form-group">
            <label for="task_deadline">Deadline:</label>
            Assign Date: <?php echo $assign_date; ?>   Submit Date: <?php echo $user_submit_date; ?>
          </div>
          <?php if($work_details != null) : ?>
           <div class="form-group alert alert-info">
            <h6>Submitted Works Details:</h6>
            <?php echo $work_details; ?>
          </div>
        <?php endif; ?>
        <?php if($status != 'Completed') : ?>
          <div class="form-group">
            <label for="summernote">Review:</label>
            <textarea name="review" id="summernote" class="summernote"><?php echo $review; ?></textarea>
          </div>

           <div class="form-group">
            <label for="status">Update Status:</label>
            <select name="new_status" class="custom-select" id="status">

              <option value="<?php echo $status; ?>" selected><?php echo $status; ?></option>

              <option value="Modification">Modification</option>
              <option value="Completed">Completed</option>
              <option value="NotApproved">Not Approved</option>
            </select>
          </div>

          <div class="form-group"> 
            <input type="submit" name="task_review"  value="Review Task" class="btn btn-success">
          </div>
          <?php else : ?>
          <?php if($review != null) : ?>
          <div class="form-group alert alert-primary">
            <h6>Review Details:</h6>
            <?php echo   $review; ?>
          </div>
          <?php endif; ?>
        <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>
       

<?php require_once('footer.php'); ?>