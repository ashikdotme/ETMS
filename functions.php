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


 ?>