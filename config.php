<?php 
$dbhost = "localhost";
$dbname = "etms";
$dbuser = "root";
$dbpassword = "";
date_default_timezone_set("Asia/Dhaka");
try{
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Conncetion Error: ".$e->getMessage();
}


 ?>