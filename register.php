<?php 
require_once('config.php');
require_once('functions.php');

if(isset($_POST['submit_register'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $birthday = $_POST['birthday'];
    $blood_group = $_POST['blood_group'];
    $fathers_name = $_POST['fathers_name'];
    $mothers_name = $_POST['mothers_name'];
    $f_m_mobile = $_POST['f_m_mobile'];
    $edu_level = $_POST['edu_level'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $date = date('Y-m-d H:i:s');

    $emailCount = inputCount('email',$email);
    $mobileCount = inputCount('mobile',$mobile);

    if(empty($first_name)){
        $error = "First Name is Required!";
    }
    else if(empty($last_name)){
        $error = "Last Name is Required!";
    }
    else if(empty($email)){
        $error = "Email is Required!";
    }
    else if($emailCount == 1){
        $error = "Email Already Exits!";
    }
    else if(empty($mobile)){
        $error = "Mobile is Required!";
    } 
    else if(!is_numeric($mobile)){
        $error = "Invalid Mobile Number!";
    } 
    else if(strlen($mobile) != 11){
        $error = "Invalid Mobile Number!";
    } 
    else if($mobileCount == 1){
        $error = "Mobile Number Already Exits!";
    }
    else if(empty($fathers_name)){
        $error = "Fathers's Name is Required!";
    }
    else if(empty($mothers_name)){
        $error = "Mother's Name is Required!";
    }
    else if(empty($f_m_mobile)){
        $error = "Father's or Mother's Number is Required!";
    }
    else if(empty($password)){
        $error = "Password is Required!";
    }
    else{
        $password = SHA1($password);

        $stm=$pdo->prepare("INSERT INTO 
        em_users(
            first_name,
            last_name,
            email,
            mobile,
            birthday,
            blood_group,
            father_name,
            mother_name,
            f_or_m_mobile,
            edu,
            address,
            password,
            register_date
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stm->execute(array($first_name,$last_name,$email,$mobile,$birthday,$blood_group,$fathers_name,$mothers_name,$f_m_mobile,$edu_level,$address,$password,$date));

        $success = "Registration Successfully!";
    }


}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ETMS - Register</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <?php if(isset($error)) : ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($success)) : ?>
                                <div class="alert alert-success">
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>

                            <form class="user" method="POST" action="">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="first_name" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name *">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name *">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address *">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="mobile" class="form-control form-control-user" id="mobileNumber"
                                        placeholder="Mobile Number *">
                                </div>
 

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" name="birthday" class="form-control form-control-user"
                                            id="birthday" placeholder="Birthday">
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="blood_group" class="form-control " id="blood_group">
                                            <option value="A+" selected>A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="fathers_name" class="form-control form-control-user" id="father"
                                        placeholder="Father's Name *">
                                </div>

                                 <div class="form-group">
                                    <input type="text" name="mothers_name" class="form-control form-control-user" id="mother"
                                        placeholder="Mother's Name *">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="f_m_mobile" class="form-control form-control-user" id="f_m_mobile"
                                        placeholder="Father's or Mother's Mobile *">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="edu_level" class="form-control form-control-user" id="edu"
                                        placeholder="Education Level">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="address" class="form-control form-control-user" id="Address"
                                        placeholder="Address">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" id="password"
                                        placeholder="Login Password *">
                                </div>



                                <input type="submit" name="submit_register" class="btn btn-primary btn-user btn-block" value="Register Account">
                                 
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>