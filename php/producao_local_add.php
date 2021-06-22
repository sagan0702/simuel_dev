<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
extract($_REQUEST);
// 	if($n_os==""){
// 		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
// 		exit;
// 	}elseif($n_ciclo==""){
// 		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
// 		exit;
// 	}else{
		//converter para data br -> data mysql
		//var_dump($_POST);
		$userCount	=	$db->getQueryCount('producao','id_producao');
		if($userCount[0]['total']<20){
			$data	=	array(
							'id_ciclo'=>$id_ciclo,
							'id_os'=>$id_os,
							'id_local'=>$id_local,
							'n_os'=>$n_os,
							'ue2009p'=>$ue2009p,
							'ue2010p'=>$ue2010p,
							'ue2011p'=>$ue2011p,
							'ue2013p'=>$ue2013p,
							'ue2015p'=>$ue2015p,
							'ue2020p'=>$ue2020p,
							'ue2022p'=>$ue2022p,
							'nue_sem_chamado'=>$nue_sem_chamado,
							'nue_com_chamado'=>$nue_com_chamado,
							'bat_reserva'=>$bat_reserva,
							'bat_subst'=>$bat_subst,
							'bat_vazando'=>$bat_vazando,
							'bat_oxidada'=>$bat_oxidada,
							'observacao'=>$observacao,
						);
			$insert	=	$db->insert('producao',$data);
		// --------- ATUALIZA TABELA STATUS  -------------------
		// $ids_local = $_SESSION['id_local'];
		// //echo $id_local;
		// $condition =	"AND id_local =".$ids_local;
		// $userData	=	$db->getAllRecords('producao','*',$condition,'ORDER BY id_producao DESC');
	   // --- pegar valores de status 
	    session_start();
       //print_r($data);
		$ids_local = $_SESSION['id_local'];
		echo "valor de id_local = ". $ids_local;
		$condition =	"AND id_local =".$ids_local;
		$userData	=	$db->getAllRecords('status','*',$condition,'ORDER BY id_local');
		//var_dump($userData);
		//print_r($userData);
        //--------------------
		if(count($userData)>0){
			$s	=	'';
			foreach($userData as $val){
				$s++;
				$totue2009_v = $val['totue2009']; 
				$totue2010_v = $val['totue2010']; 
				$totue2011_v = $val['totue2011'];
				$totue2013_v = $val['totue2013'];
				$totue2015_v = $val['totue2015'];
				$totue2020_v = $val['totue2020'];
				$totue2022_v = $val['totue2022'];
				$tnue_sem_chamado_v = $val['tnue_sem_chamado'];
				$tnue_com_chamado_v = $val['tnue_com_chamado'];
				$tbat_reserva_v = $val['tbat_reserva'];
				$tbat_subst_v = $val['tbat_subst'];
				$tbat_vazando_v = $val['tbat_vazando']; 
				$tbat_oxidada_v = $val['tbat_oxidada'];
		        $tot_prod = $totue2009_v + $totue2010_v + $totue2011_v + $totue2013_v + $totue2015_v + $totue2020_v +$totue2022_v;
			}
		}else{
			
		} 			
		//------- somar os valores de status com os valores da producao atual

		 $totue2009_v = $totue2009_v + $ue2009p; 
		 $totue2010_v = $totue2010_v + $ue2010p;
		 $totue2011_v = $totue2011_v + $ue2011p;
		 $totue2013_v = $totue2013_v + $ue2013p;
		 $totue2015_v = $totue2015_v + $ue2015p;
		 $totue2020_v = $totue2020_v + $ue2020p;
		 $totue2022_v = $totue2022_v + $ue2022p;
		 $tnue_sem_chamado_v = $tnue_sem_chamado_v + $nue_sem_chamado;
		 $tnue_com_chamado_v = $tnue_com_chamado_v  + $nue_com_chamado;
		 $tbat_reserva_v = $tbat_reserva_v + $bat_reserva;
		 $tbat_subst_v = $tbat_subst_v + $bat_subst;
		 $tbat_vazando_v =  $tbat_vazando_v  + $bat_vazando; 
		 $tbat_oxidada_v = $tbat_oxidada_v + $bat_oxidada;
		
		//------- inserir os valores na tabela status - update
			if($userCount[0]['total']<20){
				$data	=	array(
								'id_local'=>$id_local,
								'totue2009'=>$totue2009_v,
								'totue2010'=>$totue2010_v,
								'totue2011'=>$totue2011_v,
								'totue2013'=>$totue2013_v,
								'totue2015'=>$totue2015_v,
								'totue2020'=>$totue2020_v,
								'totue2022'=>$totue2022_v,
								'tnue_sem_chamado'=>$tnue_sem_chamado_v,
								'tnue_com_chamado'=>$tnue_com_chamado_v ,
								'tbat_reserva'=>$tbat_reserva_v,
								'tbat_subst'=>$tbat_subst_v,
								'tbat_vazando'=>$tbat_vazando_v,
								'tbat_oxidada'=>$tbat_oxidada_v,
							);
						}
						// $data	=	array(
						// 	'n_ciclo'=>$n_ciclo,
						// 	'data_inicio'=>$data_inicio,
						// 	'data_fim'=>$data_fim,
						// 	'estado'=>$estado,
						// 	);
						// $update	=	$db->update('ciclo',$data,array('id_ciclo'=>$editId));

			$update	=	$db->update('status',$data,array('id_local'=>$id_local));	
			//$update	=	$db->update('status',$data,array('id_local'=>$id_local));		
			if($insert){
				header('location:/simuel/producao_local.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/producao_local.php?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adicionar Produção Local</title>
	<style>
	#ue2009p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
    #ue2010p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#ue2011p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#ue2013p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#ue2015p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#ue2020p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#ue2022p
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#nue_com_chamado
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#nue_sem_chamado
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#bat_reserva
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#bat_subst
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#bat_vazando
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	#bat_oxidada
    {
        background-color: #F5F6CE;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
	</style>
  	<?php include_once('formatacao.php');
	include_once('consulta_ciclo_os.php');
    include ("conexao.php");
	//session_start();
	$dadosConexao = mysqli_get_host_info($conexao);
	if (!isset($_SESSION["usuario"])) {
		header('Location: ../index.php');
		exit();
	}
	// $id_ciclo = $_SESSION['max_id_ciclo'];
	// $id_os = $_SESSION['max_id_os'];
    // $id_local = $_SESSION['id_local']; 
	// var_dump($id_ciclo, $id_os, $id_local );
    ?>
	<script src="../js/funcaoOS.js"></script> 
</head>
<body>

	<!--- MENSAGENS -->
   	<div class="container">
		<!-- <h3>Adicionar Produção Local</h3> -->
		<?php  
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Item inserido com sucesso!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Item NÃO inserido! <strong>Tente novamente!</strong></div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete and then try again <strong>We set limit for security reasons!</strong></div>';
		}
		?>

		<div class="card">   <!---CARD ADICIONAR --->
			<div class="card-header"> <h3>Adicionar Produção Local</h3> 
				<a href="/simuel/producao_local.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Produção</a>
			</div>
			<div class="card-body">		
					<form method="post">
				
					<input type="hidden" name="id_ciclo" value="<?php echo $_SESSION['max_id_ciclo']; ?>">
					<input type="hidden" name="id_os" value="<?php echo $_SESSION['max_id_os']; ?>">
					<input type="hidden" name="id_local" value="<?php echo $_SESSION['id_local']; ?>">
					<input type="hidden" name="n_os" value="<?php echo $_SESSION['max_n_os']; ?>">
					<!-- FIM CAMPOS AUX --->
						<div class="row">
						<div class="col-md-3 ">
								<label>Nº do Ciclo: </label>
								<div id="n_ciclo2" name="n_ciclo2"><h5><?= $_SESSION['max_n_ciclo'] ?></h5></div>
							</div>
							<div class="col-md-3 ">
								<label>Nº da OS:</label>
								<div id ="n_os2" name="n_os2" ><h5> <?= $_SESSION['max_n_os'] ?> </h5> </div>
							</div>
							<div class="col-md-3 ">
								<label>Local:</label>
								<div id ="n_local2" name="n_local2"  > <h5><?= $_SESSION['local'] ?> </h5> </div>
							</div>
							<div class="col-md-3 ">
								<label><h5>Data:<?php echo date('d/m/Y')?></h5></label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
								<label> <h5>Total Urnas com STE realizado</h5></label>
							</div>
							<div class="col-md-2">
								<label for="urna09"><h5>UE2009:</h5></label>
								<input type="text" class="form-control" name="ue2009p" id="ue2009p" value="0" onkeypress="$(this).mask('0000')" onfocusout="totalUrna()">
							</div>
							<div class="col-md-2 ">
								<label for="urna10"><h5>UE2010:</h5></label>
								<input type="text" class="form-control" name="ue2010p" id="ue2010p" value="0"  onkeypress="$(this).mask('0000')" onfocusout="totalUrna()" >
							</div>
							<div class="col-md-2 ">
								<label for="urna11"><h5>UE2011:</h5></label>
								<input type="text" class="form-control"  name="ue2011p" id="ue2011p" value="0" onkeypress="$(this).mask('0000')" onfocusout="totalUrna()">
							</div>
							<div class="col-md-2 ">
								<label for="urna13"><h5>UE2013:</h5></label>
								<input type="text" class="form-control" name="ue2013p" id="ue2013p" value="0" onkeypress="$(this).mask('0000')" onfocusout="totalUrna()">
							</div>
							<div class="col-md-2 ">
								<label for="urna15"><h5>UE2015:</h5></label>
								<input type="text" class="form-control" name="ue2015p" id="ue2015p" value="0" onkeypress="$(this).mask('0000')" onfocusout="totalUrna()" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 ">
								<label for="urna21"><h5>UE2020:</h5></label>
								<input type="text" class="form-control" name="ue2020p" id="ue2020p" value="0"  onfocusout="totalUrna()" onkeypress="$(this).mask('0000')"  >
							</div>
							<div class="col-md-2">
								<label for="urna22"><h5>UE2022:</h5></label>
								<input type="text" class="form-control" name="ue2022p" id="ue2022p" onfocusout="totalUrna()" value="0" onkeypress="$(this).mask('0000')"  >
							</div>
							<div class="col-md-2">
								<label for="urna22"><h5>Total de Urnas:</h5></label>
                                <div id="total_urnas"></div>
							</div>
						</div>
						</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
						<div class="form-row">
						
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="urna21"><h5>Chamados de Manutenção Corretiva:</h5></label>
								<div class="col-md-12">
								</div>
							</div>
							<div class="col-md-2 ">
								<label for="urna21">Urnas COM chamado aberto:</label>
								<input type="text" class="form-control" name="nue_com_chamado"  id="nue_com_chamado" onkeypress="$(this).mask('0000')" value="0" required>
							</div>
							<div class="col-md-2">
								<label for="urna22">Urnas SEM chamado aberto:</label>
								<input type="text" class="form-control" name="nue_sem_chamado" id="nue_sem_chamado" onkeypress="$(this).mask('0000')" value="0" required>
							</div>
						</div>	
						</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
						<div class="row">
							<div class="col-md-12 ">
								<label for="urna21"><h5>Situação das baterias</h5></label>
							</div>
							<div class="col-md-2">
								<label for="urna22">Reserva:</label>
								<input type="text" class="form-control" value="0" name="bat_reserva" id="bat_reserva" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Substituídas:</label>
								<input type="text" class="form-control" value="0" name="bat_subst" id="bat_subst" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Com vazamento (em garantia):</label>
								<input type="text" class="form-control"  value="0" name="bat_vazando" id="bat_vazando" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Com oxidação (em garantia):</label>
								<input type="text" class="form-control" value="0" name="bat_oxidada"  id="bat_oxidada" onkeypress="$(this).mask('0000')" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="urna22">Observações (opcional):</label>
								<input type="text" class="form-control" name="observacao" id="observacao" >
								</div>	
						</div>	
						<div class="row">
							<div class="col-lg-2 ">
								</br>
								<button type="submit" name="submit" value="submit" id="submit_prod" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Enviar Produção</button>
							</div>
						</div>
					</form>
				</div>
				<div class="card-footer text-muted">
				SIMUEL 
				</div>
			</div> 
			
			
		</div>
	</div>
	<div class="container my-4">	
	</div>
 
	<script>
		
	// alert ("UE2015p adicionar producao -> ".$ue2015p) ;
	// alert ("UE2015 valor atual da tabela producao-> ".$val['totue2015']);
	// alert ("UE2015 valor da tabela status-> ".$val['totue2015']);

		
		
	</script>
</body>
</html>