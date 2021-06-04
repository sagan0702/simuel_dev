<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('os',array('id_os'=>$_REQUEST['delId']));
	header('location: /simuel/os.php?msg=rds');
	exit;
}
?>