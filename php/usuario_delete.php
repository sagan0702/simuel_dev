<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('usuarios',array('id_usuario'=>$_REQUEST['delId']));
	header('location: /simuel/usuarios.php?msg=rds');
	exit;
}
?>