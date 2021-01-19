<?php 
require_once('config.php');


function inputCount($col,$val){
	global $pdo;
    $stm=$pdo->prepare("SELECT $col FROM em_users WHERE $col=?");
    $stm->execute(array($val));
    $count=$stm->rowCount();
    return $count;
}

function em_user($id,$col){
	global $pdo;
    $stm=$pdo->prepare("SELECT $col FROM em_users WHERE u_id=?");
    $stm->execute(array($id));
   	$result=$stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col"];
}
function em_user_count(){
    global $pdo;
    $stm=$pdo->prepare("SELECT * FROM em_users");
    $stm->execute();
    $count=$stm->rowCount();
    return $count;
}

function em_admin($id,$col){
    global $pdo;
    $stm=$pdo->prepare("SELECT $col FROM em_admins WHERE ad_id=?");
    $stm->execute(array($id));
    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col"];
}

function em_att_submit($date,$user_id){
    global $pdo;
    $stm=$pdo->prepare("SELECT em_id,user_time FROM em_attendance WHERE DATE(user_time) = ? AND em_id=?");
    $stm->execute(array($date,$user_id));
    // $result=$stm->fetchAll(PDO::FETCH_ASSOC);
   return $result = $stm->rowCount();
    // return $result[0]["user_time"];
    // print_r($result);
}

// echo em_att_submit('2020-12-20','2');

function checkAttendance($user_id,$checkDate){
    global $pdo;
    $stm=$pdo->prepare("SELECT * FROM em_attendance WHERE em_id=? AND DATE(user_time) = ?");
    $stm->execute(array($user_id,$checkDate));
    // $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    // return $result[0]["$col"];
    // $user_time = $result[0]["user_time"];
    // return date('Y-m-d',strtotime($user_time));

    return $result = $stm->rowCount();
}

function checkAttendanceCount($checkDate){
    global $pdo;
    $stm=$pdo->prepare("SELECT * FROM em_attendance WHERE DATE(user_time) = ?");
    $stm->execute(array($checkDate));
    // $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    // return $result[0]["$col"];
    // $user_time = $result[0]["user_time"];
    // return date('Y-m-d',strtotime($user_time));

    return $result = $stm->rowCount();
}

function checkAttInfo($user_id,$checkDate,$col){
    global $pdo;
    $stm=$pdo->prepare("SELECT * FROM em_attendance WHERE em_id=? AND DATE(user_time) = ?");
    $stm->execute(array($user_id,$checkDate));
    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col"];
    
}


// echo checkAttInfo(1,'2020-12-17','user_time');

// Get Monthly Total Attendance..
function checkAttEMCount($year,$month,$emID){
    global $pdo;
    $stm=$pdo->prepare("SELECT user_time,em_id FROM em_attendance WHERE YEAR(user_time) = ? AND MONTH(user_time) = ? AND em_id=?");
    $stm->execute(array($year,$month,$emID));

    return $result = $stm->rowCount();
}

// Get Monthly Total Practice Class
function MonthlyPracticeClass($year,$month,$emID){
    global $pdo;
    $stm=$pdo->prepare("SELECT date_time,user_id FROM em_class WHERE YEAR(date_time) = ? AND MONTH(date_time) = ? AND user_id=?");
    $stm->execute(array($year,$month,$emID));

    return $result = $stm->rowCount();
}

// Get Monthly Total Pending Task
function MonthlyTask($year,$month,$emID,$status){
    global $pdo;
    $stm=$pdo->prepare("SELECT date_time,user_id FROM em_task WHERE YEAR(date_time) = ? AND MONTH(date_time) = ? AND user_id=? AND status=?");
    $stm->execute(array($year,$month,$emID,$status));

    return $result = $stm->rowCount();
}

function MonthlyTotalTask($year,$month,$emID){
    global $pdo;
    $stm=$pdo->prepare("SELECT date_time,user_id FROM em_task WHERE YEAR(date_time) = ? AND MONTH(date_time) = ? AND user_id=?");
    $stm->execute(array($year,$month,$emID));

    return $result = $stm->rowCount();
}

/************* Yearly Report **************/

// Get Yearly Total Attendance..
function checkAttEYCount($year,$emID){
    global $pdo;
    $stm=$pdo->prepare("SELECT user_time,em_id FROM em_attendance WHERE YEAR(user_time) = ? AND em_id=?");
    $stm->execute(array($year,$emID));

    return $result = $stm->rowCount();
}

// Get Yearly Total Practice Class
function YearPracticeClass($year,$emID){
    global $pdo;
    $stm=$pdo->prepare("SELECT date_time,user_id FROM em_class WHERE YEAR(date_time) = ? AND user_id=?");
    $stm->execute(array($year,$emID));

    return $result = $stm->rowCount();
}

// Get Yearly Total Pending Task
function YearlyTask($year,$emID,$status){
    global $pdo;
    $stm=$pdo->prepare("SELECT date_time,user_id FROM em_task WHERE YEAR(date_time) = ? AND user_id=? AND status=?");
    $stm->execute(array($year,$emID,$status));

    return $result = $stm->rowCount();
}

// Date to Date Practice Class
function dateTodatePracticeClass($start_date,$end_date,$emID){
    global $pdo;
    $stm=$pdo->prepare("SELECT date_time,user_id FROM em_class WHERE date_time BETWEEN  ? AND ? AND user_id=?");
    $stm->execute(array($start_date,$end_date,$emID));

    return $result = $stm->rowCount();
}



// Email 

function ETMS_EMAIL_ADMIN($sub,$message){
    $to = "ashiktpi30@gmail.com";

    $from = "ashikcse3@gmail.com";
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $mail = mail($to,$sub,$message,$headers);
    if($mail == true){
        return true;
    }else{
        return false;
    }
}

 ?>