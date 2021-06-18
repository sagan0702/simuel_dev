<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('producao',array('id_producao'=>$_REQUEST['delId']));
	header('location: /simuel/producao_local.php?msg=rds');
	exit;
}







?>