<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ETMS - Forget Password</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">


    <style type="text/css">
        #errorMsg {
            background: red;
            color: #FFF;
            padding: 3px 14px;
            border-radius: 3px;
            margin-top: 10px;
            display: none;
        } 
        #successMsg {
            background: green;
            color: #FFF;
            padding: 3px 14px;
            border-radius: 3px;
            margin-top: 10px;
            display: none;
        }

        #resetCodeForm{
            display: none;
        }

        #passwordForm{
            display: none;
        }
    </style>

</head>


<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="POST" id="forgetForm">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="forgetEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>

                                    <form class="user" method="POST" id="resetCodeForm">
                                        <div class="form-group">
                                            <label for="code">Type Your Receive Code:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="user_code" placeholder="Type your Email Code">
                                        </div>
                                        <input type="hidden" name="" id="p_user_id">
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            Submit Code
                                        </button>
                                    </form>

                                    <form class="user" method="POST" id="passwordForm">
                                        <div class="form-group">
                                            <label for="new_password">New Password:</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="new_password" >
                                        </div>

                                        <div class="form-group">
                                            <label for="cnew_password">Confirm New Password:</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="cnew_password" >
                                        </div> 
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            Change Password
                                        </button>
                                    </form>


                                    <div id="successMsg">
                                        
                                    </div>
                                    <div id="errorMsg">
                                        
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
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

        </div>

    </div>

     <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<?php 

if(isset($_GET['code'])){

$e_code = $_GET['code'];
$e_id = $_GET['id'];

?> 

<script>
$('#forgetForm').hide();    
$('#resetCodeForm').show();    

var js_user_code = '<?php echo $e_code;?>';

$('#user_code').val(js_user_code);
$('#p_user_id').val('<?php echo $e_id;?>');

</script>

<?php 
}
?>


    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script>
        $('#forgetForm').on('submit',function(event){
            event.preventDefault();

            var forgetEmail = $('#forgetEmail').val();

            if(forgetEmail.length == 0){
                $('#errorMsg').show().text('Email is Required!'); 
            }else{
                $('#errorMsg').hide(); 

                $.ajax({
                    type:'POST',
                    url: 'ajaxRequest.php',
                    dataType: 'JSON',
                    data:{
                        email:forgetEmail
                    },
                    success:function(response){
                        

                        console.log(response);
                        if(response.success != null){
                            $('#successMsg').show(); 
                            $('#successMsg').text(response.success);
                            $('#p_user_id').val(response.userid);

                            $('#errorMsg').hide(); 

                            $('#forgetForm').hide();
                            $('#resetCodeForm').show();
                        }

                        if(response.error != null){
                            $('#errorMsg').text(response.error);
                            $('#errorMsg').show(); 
                            $('#successMsg').hide(); 
                        }
                    }
                });
            }
 
        });

        // Reset Form Code
        $('#resetCodeForm').on('submit',function(event){
            event.preventDefault();

            var user_code = $('#user_code').val();
            var user_id = $('#p_user_id').val();

            if(user_code.length == 0){
                $('#errorMsg').show().text('Code Field is Required!'); 
            }else{ 
                $.ajax({
                    type:'POST',
                    url: 'ajaxRequest.php',
                    dataType: 'JSON',
                    data:{
                        userCode:user_code,
                        user_id:user_id
                    },
                    success:function(response){
                         
                        console.log(response);
                        if(response.success != null){
                            $('#successMsg').show(); 
                            $('#successMsg').text(response.success);

                            $('#errorMsg').hide(); 

                            $('#forgetForm').hide();
                            $('#resetCodeForm').hide();

                            $('#passwordForm').show();
                        }

                        if(response.error != null){
                            $('#errorMsg').text(response.error);
                            $('#errorMsg').show(); 
                            $('#successMsg').hide(); 
                        }
                    }
                });
            }
 
        });


        // Set your new password
        $('#passwordForm').on('submit',function(event){
            event.preventDefault();

            var new_password = $('#new_password').val();
            var cnew_password = $('#cnew_password').val();
            var user_id = $('#p_user_id').val();

            if(new_password.length == 0){
                $('#errorMsg').show().text('New Password is Required!'); 
                $('#successMsg').hide();
            }else if(cnew_password.length == 0){
                $('#errorMsg').show().text('Confirm Password is Required!'); 
                $('#successMsg').hide();
            }
            else if(cnew_password != new_password){
                $('#errorMsg').show().text("New Password & Confirm Password Does't Match!"); 
                $('#successMsg').hide();
            }
            else{
                $('#errorMsg').hide(); 

                $.ajax({
                    type:'POST',
                    url: 'ajaxRequest.php',
                    dataType: 'JSON',
                    data:{
                        cnew_password:cnew_password,
                        user_id:user_id
                    },
                    success:function(response){
                         
                        console.log(response);
                        if(response.success != null){
                            $('#successMsg').show(); 
                            $('#successMsg').text(response.success);

                            $('#errorMsg').hide(); 

                            $('#forgetForm').hide();
                            $('#resetCodeForm').hide();

                            $('#passwordForm').show();
                        }

                        if(response.error != null){
                            $('#errorMsg').text(response.error);
                            $('#errorMsg').show(); 
                            $('#successMsg').hide(); 
                        }
                    }
                });
            }
 
        });




    </script>

</body>

</html>