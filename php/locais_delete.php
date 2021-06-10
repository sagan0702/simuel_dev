<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('local',array('id_local'=>$_REQUEST['delId']));
	header('location: /simuel/locais.php?msg=rds');
	exit;
}
?>