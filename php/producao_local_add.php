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
							'bat_carga_ok'=>$bat_carga_ok,
							'bat_sem_carga'=>$bat_sem_carga,
							'bat_vazando'=>$bat_vazando,
							'bat_oxidada'=>$bat_oxidada,
							'observacao'=>$observacao,
						);
			$insert	=	$db->insert('producao',$data);

		// --------- atualiza tabela status  -------------------

		$totue2009_v = $val['totue2009'];
		$totue2010_v = $val['totue2010'];
		$totue2011_v = $val['totue2011'];
		$totue2013_v = $val['totue2013'];
		$totue2015_v = $val['totue2015'];
		$totue2020_v = $val['totue2020'];
		$totue2022_v = $val['totue2022'];
		$tnue_sem_chamado_v = $val['totue2009'];
		$tnue_com_chamado_v = $val['totue2009'];
		$tbat_carga_ok_v = $val['totue2009'];
		$tbat_vazando_v = $val['totue2009'];
		$tbat_oxidada_v = $val['totue2009'];

			$userCount	=	$db->getQueryCount('status','id_status');
			if($userCount[0]['total']<20){
				$data	=	array(
							
								'id_local'=>$id_local,
								'id_os'=>$id_os,
								'totue2009'=>$ue2009p + $totue2009_v,
								'totue2010'=>$ue2010p + $totue2010_v,
								'totue2011'=>$ue2011p + $totue2011_v,
								'totue2013'=>$ue2013p + $totue2013_v,
								'totue2015'=>$ue2015p + $totue2015_v,
								'totue2020'=>$ue2020p + $totue2020_v,
								'totue2022'=>$ue2022p + $totue2022_v,
								'tnue_sem_chamado'=>$nue_sem_chamado + $tnue_sem_chamado_v,
								'tnue_com_chamado'=>$nue_com_chamado + $tnue_com_chamado_v ,
								'tbat_carga_ok'=>$bat_carga_ok + $tbat_carga_ok_v,
								'tbat_sem_carga'=>$bat_sem_carga + $tbat_carga_ok_v,
								'tbat_vazando'=>$bat_vazando + $tbat_vazando_v,
								'tbat_oxidada'=>$bat_oxidada + $tbat_oxidada_v,
								
							);
						}
			//$insert	=	$db->update ('status',$data);	
			$update	=	$db->update('status',$data,array('id_local'=>$id_local));		

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
  	<?php include_once('formatacao.php');
	include_once('consulta_ciclo_os.php');
    include ("conexao.php");
	// session_start();
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
								<div id="n_ciclo2" name="n_ciclo2"><?= $_SESSION['max_n_ciclo'] ?></div>
							</div>
							<div class="col-md-3 ">
								<label>Nº da OS:</label>
								<div id ="n_os2" name="n_os2" > <?= $_SESSION['max_n_os'] ?>  </div>
							</div>
							<div class="col-md-3 ">
								<label>Local:</label>
								<div id ="n_local2" name="n_local2"  > <?= $_SESSION['local'] ?>  </div>
							</div>
							<div class="col-md-3 ">
								<label>Data:</label>
								<h6>  <?php echo date('d/m/Y') ?> <h6> 
							</div>
							
						</div>

						<div class="row">
							<div class="col-md-12">
							</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
								<label> <h5>Total Urnas com STE realizado</h5></label>

							</div>
						
							<div class="col-md-2">
								<label for="urna09">UE2009:</label>
								<input type="text" class="form-control" name="ue2009p" id="ue2009p" value="0" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna10">UE2010:</label>
								<input type="text" class="form-control" name="ue2010p" id="ue2010p" value="0"  onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna11">UE2011:</label>
								<input type="text" class="form-control"  name="ue2011p" id="ue2011p" value="0" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna13">UE2013:</label>
								<input type="text" class="form-control" name="ue2013p" id="ue2013p" value="0" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna15">UE2015:</label>
								<input type="text" class="form-control" name="ue2015p" id="ue2015p" value="0" onkeypress="$(this).mask('0000')"  >
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-2 ">
								<label for="urna21">UE2020:</label>
								<input type="text" class="form-control" name="ue2020p" id="ue2020p" value="0" onkeypress="$(this).mask('0000')"  >
							</div>
							<div class="col-md-2">
								<label for="urna22">UE2022:</label>
								<input type="text" class="form-control" name="ue2022p" id="ue2022p" value="0" onkeypress="$(this).mask('0000')"  >
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
								<label for="urna22">Recarregadas:</label>
								<input type="text" class="form-control" value="0" name="bat_carga_ok" id="bat_carga_ok" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Sem carga:</label>
								<input type="text" class="form-control" value="0" name="bat_sem_carga" id="bat_sem_carga" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Com vazamento:</label>
								<input type="text" class="form-control"  value="0" name="bat_vazando" id="bat_vazando" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Com oxidação:</label>
								<input type="text" class="form-control" value="0" name="bat_oxidada"  id="bat_oxidada" onkeypress="$(this).mask('0000')" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="urna22">Observações (opcional):</label>
								<input type="text" class="form-control" name="observacao" id="observacao" >
								</div>	
						</div>	
						<div class="col-md-2 ">
							<button type="submit" name="submit" value="submit" id="submit_prod" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Enviar Produção</button>
						</div>
					</form>
				</div>
			</div> 
			
			<div class="card-footer text-muted">
				SIMUEL 
			</div>
		</div>
	</div>
	<div class="container my-4">	
	</div>
 
	<script>
		
	
		
		
	</script>
</body>
</html>