<?php 
require_once('config.php');
session_start();

if(isset($_POST['email'])){
    $email = $_POST['email'];

    $stm=$pdo->prepare("SELECT u_id,email,password FROM em_users WHERE email=?");
    $stm->execute(array($email));
    $userCount=$stm->rowCount();


    if($userCount == 1){

    // $userData = $stm->fetchAll(PDO::FETCH_ASSOC);


        //Get User iD
        $result=$stm->fetchAll(PDO::FETCH_ASSOC);
        $userid=$result[0]['u_id'];

        $reset_code = rand(99999,99999999);

        $from = "ashikcse3@gmail.com";

        $stm=$pdo->prepare("UPDATE em_users SET reset_code = ? WHERE email=?");
        $stm->execute(array($reset_code,$email));
 
        $link = 'https://coderit.fun/etms/forgot-password.php?code='.$reset_code.'&id='.$userid;
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


        $message = "Your Password Reset Code is:"."\r\n";
        $message .= '<pre>'.$reset_code.'</pre>'."\r\n";
        $message .= '<a style="background:green;color:white;padding:10px 20px;display:inline-block;" href="'.$link.'">Click to Reset Password</a>'."\r\n";

        $mail = mail($email,"Reset Password",$message,$headers);
        if($mail){
            $success =  "Reset Code send success, Check your Email.";
        }

    }else{
        $error = "Email Does't Match!";
    }

 
    $response = array(
        'success' =>  $success,
        'error'   => $error,
        'userid'  => $userid
    );

    echo json_encode($response);


} 

// Submit Reset Code
if(isset($_POST['userCode'])){
    $userCode = $_POST['userCode'];
    $user_id = $_POST['user_id'];

    $stm=$pdo->prepare("SELECT u_id,email,reset_code FROM em_users WHERE u_id=? AND reset_code=?");
    $stm->execute(array($user_id,$userCode));
    $userCount2=$stm->rowCount();


    if($userCount2 == 1){ 
        $success = "Code is Working";
        $getEmail = $stm->fetchAll(PDO::FETCH_ASSOC);
        $getEmail = $getEmail['0']['email'];
        
        $_SESSION['forgetUserEmail'] = $getEmail;

    }else{
        $error = "Your Code is Wrong!";
    }
 
    $response = array(
        'success' =>  $success,
        'error'   => $error
    );

    echo json_encode($response); 
}
 

if(isset($_POST['cnew_password'])){
    $user_id = $_POST['user_id'];
    $cnew_password = $_POST['cnew_password'];
 

    $stm=$pdo->prepare("SELECT u_id,email,password FROM em_users WHERE email=?");
    $stm->execute(array($_SESSION['forgetUserEmail']));
    $userCount3=$stm->rowCount();
 
    if($userCount3 == 1){

        $cnew_password = SHA1($cnew_password);
    
        $stm=$pdo->prepare("UPDATE em_users SET password = ? WHERE email=?");
        $stm->execute(array($cnew_password,$_SESSION['forgetUserEmail']));
 
       $success = "Your Password Reset Successfully!";

       session_destroy();

    }else{
        $error = "User Not Found!";
    }

 
    $response = array(
        'success' =>  $success,
        'error'   => $error
    );

    echo json_encode($response);


}
 

// Notifications  
if(isset($_POST['Notification'])){
    $noti_user_id = $_POST['noti_user_id'];
    $count0 = $_POST['count0'];

   
    

    if($count0 == 0){

        $stm=$pdo->prepare("UPDATE em_task SET task_read=? WHERE user_id=?");
        $stm->execute(array(1,$noti_user_id));

    }else{
        $stm=$pdo->prepare("SELECT user_id,status,task_read FROM em_task WHERE user_id=? AND task_read=? AND status=?");
        $stm->execute(array($noti_user_id,0,'Pending'));
        $userCount4=$stm->rowCount();
    }



    $response = array(
        'noticount' =>  $userCount4,
        'count0' => $count0
    );

    echo json_encode($response);

}
 

// Admin Notifications  
if(isset($_POST['AdNotification'])){

    $count0 = $_POST['count0'];

   
    

    if($count0 == 0){ 
        $stm=$pdo->prepare("UPDATE em_class SET ad_read=? WHERE ad_read=?");
        $stm->execute(array(1,0));

        $stm=$pdo->prepare("UPDATE em_task SET ad_read=? WHERE status=?");
        $stm->execute(array(1,'Submitted'));

        

    }else{
        $stm=$pdo->prepare("SELECT ad_read FROM em_class WHERE ad_read=?");
        $stm->execute(array(0));
        $ClassNotificationCount=$stm->rowCount();


        $stm=$pdo->prepare("SELECT ad_read,status FROM em_task WHERE  ad_read=? AND status=?");
        $stm->execute(array(0,'Submitted'));
        $TaskCount=$stm->rowCount();

        $totalNotifications = $ClassNotificationCount+$TaskCount;
    }



    $response = array(
        'noticount' =>  $totalNotifications,
        'count0' => $count0
    );

    echo json_encode($response);

}
 


// Admin  Read Notifications  
if(isset($_POST['tableName'])){

    $tableName = $_POST['tableName'];
    $DataId = $_POST['DataId'];

    if($tableName == 'em_class'){
        $stm=$pdo->prepare("UPDATE em_class SET ad_read=? WHERE c_id=?");
        $stm->execute(array(1,$DataId));
    }

    if($tableName == 'em_task'){
         $stm=$pdo->prepare("UPDATE em_task SET ad_read=? WHERE status=? AND t_id=?");
         $stm->execute(array(1,'Submitted',$DataId));

    }

   
    $response = array(
        'table_name' =>  $tableName,
        'DataId' => $DataId
    );

    echo json_encode($response);

}
 






 ?>