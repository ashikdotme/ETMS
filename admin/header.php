<?php 
require_once('../config.php');
require_once('../functions.php');
session_start();
if(!isset($_SESSION['em_admin'])){

  header('location:login.php');

}


$ad_id = $_SESSION['em_admin'][0]['ad_id'];


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>ETMS - Admin Dashbaord</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css"> 


  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="stylesheet" href="assets/css/ourstyle.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <!-- <div class="loader"></div> -->
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
              <span class="badge headerBadge1" id="NotificationsCount"></span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
              </div>
              <div class="dropdown-list-content dropdown-list-message">

                 <?php 
                 $stm=$pdo->prepare("SELECT * FROM em_task WHERE ad_read=? AND status=? ORDER BY t_id DESC");
                 $stm->execute(array(0,'Submitted'));
                 $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                 foreach($result as $row):
                ?>
                <a href="#" class="dropdown-item" data-table="em_task" data-id="<?php echo $row['t_id'];?>"> <span class="dropdown-item-avatar
                      text-white"> <img alt="image" src="<?php 
                      $photo = em_user($row['user_id'],'photo');
                      if($photo == null){
                          echo "../assets/img/undraw_profile.svg";
                      }else{
                          echo "../profilephotos/".$photo;                                        
                      }
                       ?>" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> 
                    <span class="message-user"><?php echo em_user($row['user_id'],'first_name')." ".em_user($row['user_id'],'last_name'); ?></span>
                    <span class="time messege-text"><?php echo $row['task_name']; ?></span>
                    <span class="time">
                    <?php  
                        $datetime1 = date_create($row['date_time']);
                        $datetime2 = date_create(date('Y-m-d H:i:s'));
                        $interval = date_diff($datetime1, $datetime2);
                        $total_time = $interval->format('%h Hr %i Min Ago');
                        
                        $days = $interval->format('%a');
                        if($days!=0){
                          echo $days." Days Ago";
                        }else{ 
                          echo $total_time;
                        }
                    ?> 
                  </span>
                  </span>
                </a> 
              <?php endforeach; ?>


               <?php 
                 $stm=$pdo->prepare("SELECT * FROM em_class WHERE ad_read=?  ORDER BY c_id DESC");
                 $stm->execute(array(0));
                 $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                 foreach($result as $row):
                ?>
                <a href="#" class="dropdown-item" data-table="em_class" data-id="<?php echo $row['c_id'];?>"> <span class="dropdown-item-avatar
                      text-white"> <img alt="image" src="<?php 
                      $photo = em_user($row['user_id'],'photo');
                      if($photo == null){
                          echo "../assets/img/undraw_profile.svg";
                      }else{
                          echo "../profilephotos/".$photo;                                        
                      }
                       ?>" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> 
                    <span class="message-user"><?php echo em_user($row['user_id'],'first_name')." ".em_user($row['user_id'],'last_name'); ?></span>
                    <span class="time messege-text"><?php echo $row['class_name']; ?></span>
                    <span class="time">
                    <?php  
                        $datetime1 = date_create($row['date_time']);
                        $datetime2 = date_create(date('Y-m-d H:i:s'));
                        $interval = date_diff($datetime1, $datetime2);
                        $total_time = $interval->format('%h Hr %i Min Ago');
                        
                        $days = $interval->format('%a');
                        if($days!=0){
                          echo $days." Days Ago";
                        }else{ 
                          echo $total_time;
                        }
                    ?> 
                  </span>
                  </span>
                </a> 
              <?php endforeach; ?>

              </div>
             
            </div>
          </li>


          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo em_admin($ad_id,'name'); ?></div>
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> 
              <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">ETMS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Employee</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="emAll.php">All Employee</a></li> 
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Attendance</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="AttToday.php">Today Attendance</a></li>
                <li><a class="nav-link" href="AttMonthly.php">Monthly Attendance</a></li> 
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i>
                <span>Practice Classes</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="ClassToday.php">Today Class</a></li>
                <li><a class="nav-link" href="ClassAll.php">All Class</a></li> 
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Task</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="TaskNew.php">New Task</a></li>
                <li><a class="nav-link" href="TaskUnderReview.php">Under Review</a></li>
                <li><a class="nav-link" href="TaskAll.php">All Task</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">

            <!-- Start Content Area -->