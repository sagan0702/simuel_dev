<?php 
include_once('config.php');
include('conexao.php');

// include_once('config.php');
// if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
// 	$db->delete('producao',array('id_producao'=>$_REQUEST['delId']));
// 	header('location: /simuel/producao_local.php?msg=rds');
// 	exit;
// }


if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	

	




	//------- pegar os valores da producao que será deletada
	$delId = $_REQUEST['delId'];
	$sql = "SELECT * FROM producao WHERE id_producao = $delId ";
	$result3 = mysqli_query($conexao,$sql);
	$row = mysqli_fetch_row($result3);
	$id_locals = $row[2];
	$ue2009p = $row[5];
	$ue2010p = $row[6];
	$ue2011p = $row[7];
	$ue2013p = $row[8];
	$ue2015p = $row[9];
	$ue2020p = $row[10];
	$ue2022p = $row[11];
	$nue_sem_chamado_p = $row[12];
	$nue_com_chamado_p = $row[13];
	$bat_reserva_p =  $row[14];
	$bat_subst_p = $row[15];
	$bat_vazando_p =  $row[16];
	$bat_oxidada_p = $row[17];
	
	// echo "UE-2009p - > ".$ue2009p;
	// echo "/ ";
	// echo "UE-2010p - > ".$ue2010p;
	// echo "/ ";
	// echo "UE-2011p - > ".$ue2011p;
	// echo "/ ";
	// echo "UE-2013p - > ".$ue2013p;
	// echo "/ ";
	// echo "UE-2015p- > ".$ue2015p;
	// echo "/ ";
	// echo "UE-2020p - > ".$ue2020p;
	// echo "/ ";
	// echo "UE-2022p - > ".$ue2022p;
	// echo "/ ";
	// echo "nue_sem_chamado_p - > ".$nue_sem_chamado_p;
	// echo "/ ";
	// echo "nue_com_chamado_p - > ".$nue_com_chamado_p;
	// echo "/ ";
	// echo "bat_reserva_p - > ".$bat_reserva_p;
	// echo "/ ";
	// echo "bat_subst_p - > ".$bat_subst_p;
	// echo "/ ";
	

	//echo "o valor de $delId - > " .$delId;

	//------- pegar os valores da producao do status atual do local
	$sql = "SELECT * FROM status WHERE id_local = $id_locals ";
	$result3 = mysqli_query($conexao,$sql);
	$row = mysqli_fetch_row($result3);
	$totue2009 = $row[1];
	$totue2010 = $row[2];
	$totue2011 = $row[3];
	$totue2013 = $row[4];
	$totue2015 = $row[5];
	$totue2020 = $row[6];
	$totue2022 = $row[7];
	$tnue_sem_chamado = $row[8];
	$tnue_com_chamado = $row[9];
	$tbat_reserva =  $row[10];
	$tbat_subst = $row[11];
	$tbat_vazando =  $row[12];
	$tbat_oxidada = $row[13];

	// echo "UE-2009s - > ".$totue2009;
	// echo "/ ";
	// echo "UE-2010s - > ".$totue2010;
	// echo "/ ";
	// echo "UE-2011s - > ".$totue2011;
	// echo "/ ";
	// echo "UE-2013s - > ".$totue2013;
	// echo "/ ";
	// echo "UE-2015s- > ".$totue2015;
	// echo "/ ";
	// echo "UE-2020s - > ".$totue2020;
	// echo "/ ";
	// echo "UE-2022s - > ".$totue2022;
	// echo "/ ";
	// echo "tnue_sem_chamado_p - > ".$nue_sem_chamado_p;
	// echo "/ ";
	// echo "tnue_com_chamado_p - > ".$tnue_com_chamado_p;
	// echo "/ ";
	// echo "tbat_reserva_p - > ".$bat_reserva_p;
	// echo "/ ";
	// echo "tbat_subst_p - > ".$bat_subst_p;
	// echo "/ ";
	
	
	

//------- subtrair os valores de status com os valores da producao atual

	$totue2009 = $totue2009 - $ue2009p; 
	$totue2010 = $totue2010 - $ue2010p;
	$totue2011 = $totue2011 - $ue2011p;
	$totue2013 = $totue2013 - $ue2013p;
	$totue2015 = $totue2015 - $ue2015p;
	$totue2020 = $totue2020 - $ue2020p;
	$totue2022 = $totue2022 - $ue2022p;
	$tnue_sem_chamado = $tnue_sem_chamado - $nue_sem_chamado_p;
	$tnue_com_chamado = $tnue_com_chamado  - $nue_com_chamado_p;
	$tbat_reserva =  $tbat_reserva  - $bat_subst;
	$tbat_subst = $tbat_subst - $bat_subst_p;
	$tbat_vazando = $tbat_vazando - $bat_vazando_p; 
	$tbat_oxidada = $tbat_oxidada - $bat_oxidada_p;
		
	// echo "Sub UE-2009s - > ".$totue2009;
	// echo "/ ";
	// echo "Sub UE-2010s - > ".$totue2010;
	// echo "/ ";
	// echo "Sub UE-2011s - > ".$totue2011;
	// echo "/ ";
	// echo "Sub UE-2013s - > ".$totue2013;
	// echo "/ ";
	// echo "Sub UE-2015s- > ".$totue2015;
	// echo "/ ";
	// echo "Sub UE-2020s - > ".$totue2020;
	// echo "/ ";
	// echo "Sub UE-2022s - > ".$totue2022;
	// echo "/ ";
	// echo "saldo tnue_sem_chamado - > ".$tnue_sem_chamado;
	// echo "/ ";
	// echo "saldo tnue_com_chamado - > ".$tnue_com_chamado;
	// echo "/ ";
	// echo "saldo tbat_reserva - > ".$tbat_reserva;
	// echo "/ ";
	// echo "saldo tbat_subst - > ".$tbat_subst;
	// echo "/ ";
	
//------- update a tabela status para reflerir os registros deletados	
	$sql = "UPDATE status  status 
		SET 
		`totue2009` =  $totue2009,
		`totue2010` =  $totue2010,
		`totue2011` =  $totue2011,
		`totue2013` =  $totue2013,
		`totue2015` =  $totue2015,
		`totue2020` =  $totue2020,
		`totue2022` =  $totue2022,
		`tnue_sem_chamado` = $tnue_sem_chamado,
		`tnue_com_chamado` = $tnue_com_chamado,
		`tbat_reserva` =  $tbat_reserva,
		`tbat_subst` = $tbat_subst,
		`tbat_vazando` = $tbat_vazando,
		`tbat_oxidada` = $tbat_oxidada,
		`data_atualizacao` = CURRENT_TIMESTAMP
		WHERE id_local = $id_locals" ;
		$result3 = mysqli_query($conexao,$sql);
		
		// $row = mysqli_fetch_row($result3);			
		var_dump($row);
		// $update	=	$db->update('status',$data,array('id_local'=>'delId'));	
		$db->delete('producao',array('id_producao'=>$_REQUEST['delId']));
		header('location: /simuel_dev/producao_local.php?msg=rds');
		if($insert){
			header('location:/simuel_dev/producao_local.php?msg=ras');
			exit;
		}else{
			header('location:/simuel_dev/producao_local.php?msg=ras');
			// header('location:/simuel/producao_local.php?msg=rna');
			exit;
		}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}

	
?>