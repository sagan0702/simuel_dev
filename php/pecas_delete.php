<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('pecas',array('id_peca'=>$_REQUEST['delId']));
	header('location: /simuel_dev/pecas.php?msg=rds');
	exit;
}
?>