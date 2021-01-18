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


}else{
    header('location:index.php');
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
else{
    header('location:index.php');
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
else{
    header('location:index.php');
}


 ?>