<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('equipamentos',array('id_equip'=>$_REQUEST['delId']));
	header('location: /simuel/equipamentos.php?msg=rds');
	exit;
}
?>