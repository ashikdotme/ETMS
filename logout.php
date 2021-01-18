<?php 

session_start();
session_destroy();
setcookie('rememberUser',$u_id,time()-3600,'/');
header('location:login.php');

 ?>