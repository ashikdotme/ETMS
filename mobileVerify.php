<?php 
$user_id = $_SESSION['em_user'][0]['u_id'];
$mobile_verify_status = em_user($user_id,'mobile_verify');

if(isset($_POST['send_mobile_code'])){

    $mobile = em_user($user_id,'mobile');
    $mCode = rand(1000,9999); 
    $message = "Your Verify Code is: ".$mCode;

    try{
         $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
         $paramArray = array(
         'userName' => "01751331330",
         'userPassword' => "ashik@1234",
         'mobileNumber' => $mobile,
         'smsText' => $message,
         'type' => "TEXT",
         'maskName' => '',
         'campaignName' => '',
         );
         $value = $soapClient->__call("OneToOne", array($paramArray));
    //  echo $value->OneToOneResult;
    } catch (Exception $e) {
     // echo $e->getMessage();
    }


    $stm=$pdo->prepare("UPDATE em_users SET mobile_verify_code=? WHERE u_id=?");
    $stm->execute(array($mCode,$user_id));


    $mobileSuccess = "Messgae Send Success";

}


if(isset($_POST['submit_mobile_code'])){
    $user_code = $_POST['user_mobile_code'];

    $db_code = em_user($user_id,'mobile_verify_code');


    if(empty($user_code)){
        $error = "Mobile Code Field is Required!";
    }
    if($user_code != $db_code){
         $error = "Code is Wrong!";
    }
    else{
        $stm=$pdo->prepare("UPDATE em_users SET mobile_verify=? WHERE u_id=?");
        $stm->execute(array(1,$user_id));
        $success = "Mobile Verify Success!";
    }
}


 ?>



<div class="row">
<div class="col-md-6">
<div class="verification_area">

    <?php if(isset($success)): ?>
    <div class="alert alert-success">
        <?php echo $success; ?>
    </div>
    <?php endif; ?>


    <?php if(isset($error)): ?>
    <div class="alert alert-danger">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>

   <!--  <div class="alert alert-danger">
        Please Veiry your Email 

        <a href="" class="btn btn-success f-right">Send Code</a>
    </div> -->


<?php if($mobile_verify_status == 0) : ?>
     <div class="alert alert-danger">
        Please Veiry your Mobile Number 

        <?php if(!isset($mobileSuccess)): ?>
        <form action="" method="POST">
            <div class="form-group">
                <input type="submit" name="send_mobile_code" class="btn btn-success f-right" value="Send Code">
            </div>
        </form>
        <?php else : ?>

        <form action="" method="POST">
            <div class="form-group">
                 <input type="text" name="user_mobile_code" class="form-control" placeholder="Type Your Code" id="">
            </div>
           
            <input type="submit" name="submit_mobile_code" value="Submit Code" class="btn btn-success">
        </form>

        <?php endif; ?>
          
    </div>

    <?php endif; ?>



</div>
</div>
</div>
