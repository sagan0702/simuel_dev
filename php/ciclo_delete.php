<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('ciclo',array('id_ciclo'=>$_REQUEST['delId']));
	header('location: /simuel_dev/ciclos.php?msg=rds');
	exit;
}
?>