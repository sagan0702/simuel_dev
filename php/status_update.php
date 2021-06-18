<?php include_once('config.php');

$userCount	=	$db->getQueryCount('status','id_status');
		if($userCount[0]['total']<20){
			$data	=	array(
						
							'id_local'=>$id_local,
							'id_os'=>$id_os,
							'totue2009'=>$ue2009p,
							'totue2010'=>$ue2010p,
							'totue2011'=>$ue2011p,
							'totue2013'=>$ue2013p,
							'totue2015'=>$ue2015p,
							'totue2020'=>$ue2020p,
							'totue2022'=>$ue2022p,
							'tnue_sem_chamado'=>$nue_sem_chamado,
							'tnue_com_chamado'=>$nue_com_chamado,
							'tbat_reserva'=>$bat_reserva,
							'tbat_subst'=>$bat_subst,
							'tbat_vazando'=>$bat_vazando,
							'tbat_oxidada'=>$bat_oxidada,
							
						);
			$insert	=	$db->insert('status',$data);
			
		}else{
		
		}
	

?>

