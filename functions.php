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

 ?>