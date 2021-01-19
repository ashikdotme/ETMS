<?php require_once('header.php'); ?>
<h1 class="h3 mb-4 text-gray-800">Monthly Report</h1>
<?php require_once('mobileVerify.php'); ?>
<?php 

if(isset($_COOKIE['rememberUser'])){
    $user_id = $_COOKIE['rememberUser'];
}else{
    $user_id = $_SESSION['em_user'][0]['u_id'];
}



// Total Attendance 
$c_year = date('Y');
$c_month = date('m');
// Monthly Total Attendance
$current_month_att = checkAttEMCount($c_year,$c_month,$user_id);

// Monthly Total Practice Class
$current_month_class = MonthlyPracticeClass($c_year,$c_month,$user_id);

// Monthly Total Pending Task
$current_month_pending_task = MonthlyTask($c_year,$c_month,$user_id,'Pending');
$current_month_completed_task = MonthlyTask($c_year,$c_month,$user_id,'Completed');

// Yearly Data 

$yearly_att = checkAttEYCount($c_year,$user_id);
$YearPracticeClass = YearPracticeClass($c_year,$user_id);
$yearly_pending_task = YearlyTask($c_year,$user_id,'Pending');
$yearly_completed_task = YearlyTask($c_year,$user_id,'Completed');

$MonthlyTotalTask = MonthlyTotalTask($c_year,$c_month,$user_id);
 

// $dateTodatePracticeClass = dateTodatePracticeClass('2021-01-01','2021-01-16',$user_id);

// echo $dateTodatePracticeClass;
 ?>


<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Attendance</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $current_month_att; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Practice Class</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $current_month_class; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-laptop fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Pending Tasks</div>

                     <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $current_month_pending_task; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Completed Task
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php echo $current_month_completed_task; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<h1 class="h3 mb-4 text-gray-800">Yearly Report</h1>
<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Attendance</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $yearly_att; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Practice Class</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $YearPracticeClass; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-laptop fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Pending Tasks</div>

                     <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $yearly_pending_task; ?></div>
                        </div>
                         
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Completed Task
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php echo $yearly_completed_task; ?></div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<?php require_once('footer.php'); ?>