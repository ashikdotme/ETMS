<?php require_once('header.php');

$today = date('Y-m-d');
$today_attendance = checkAttendanceCount($today);

$today_practice_class = todayPracticeClass($today);
$total_pending_task = totalTask('Pending');
$total_completed_task = totalTask('Completed');

 
// $time1 = new DateTime('2020-01-10 08:16:25');
// $time2 = new DateTime('2021-01-21 11:36:28');
// $timediff = $time1->diff($time2);
// echo $timediff->format('%d days %h hour %i minute')."<br/>";

 ?>

 
<div class="row ">
	<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Employee</h5>
                  <h2 class="mb-3 font-18"><?php echo em_user_count(); ?></h2>
                  <p class="mb-0"><span class="col-green">Total</span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/1.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Attendance</h5>
                  <h2 class="mb-3 font-18"><?php echo $today_attendance; ?></h2>
                  <p class="mb-0"><span class="col-green">Today</span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/1.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Practice Class</h5>
                  <h2 class="mb-3 font-18"><?php echo $today_practice_class; ?></h2>
                  <p class="mb-0"><span class="col-green">Today</span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/2.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Pending Task</h5>
                  <h2 class="mb-3 font-18"><?php echo $total_pending_task; ?></h2>
                  <p class="mb-0"><span class="col-green">Total</span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/3.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Complete Task</h5>
                  <h2 class="mb-3 font-18"><?php echo $total_completed_task; ?></h2>
                  <p class="mb-0"><span class="col-green">Total</span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/4.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<?php require_once('footer.php'); ?>