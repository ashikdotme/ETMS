<?php require_once('header.php'); 
$user_id = $_SESSION['em_user'][0]['u_id'];

?>
<h1 class="h3 mb-4 text-gray-800">All Practice Class</h1> 
 
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Class</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Details</th> 
                        <th>Date-Time</th> 
                    </tr>
                </thead>
                
                <tbody>
                  <?php 
                  $stm=$pdo->prepare("SELECT * FROM em_class WHERE user_id=? ORDER BY c_id DESC");
                  $stm->execute(array($user_id));
                  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                  $a=1;
                  foreach ($result as $row) :
                  ?>
                  <tr>
                    <td><?php echo $a;$a++; ?></td>
                    <td><?php echo $row['class_name']; ?></td>
                    <td><?php echo $row['class_details'];?></td>
                    <td><?php echo date('h:i A d-m-Y',strtotime($row['date_time'])) ?></td>
                  </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



<?php require_once('footer.php'); ?>